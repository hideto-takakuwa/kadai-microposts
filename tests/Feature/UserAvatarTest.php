<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserAvatarTest extends TestCase
{
    use RefreshDatabase;

    private function image(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('avatar.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII='
        ));
    }

    public function test_upload_button_is_only_shown_on_own_profile(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user)->get('/users/'.$user->id)->assertOk()->assertSee('画像を変更');
        $this->get('/users/'.$other->id)->assertOk()->assertDontSee('画像を変更')->assertSee('フォローする');
    }

    public function test_upload_updates_all_avatar_displays_and_replaces_old_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Storage::disk('public')->put('avatars/old.png', 'old image');
        $user->avatar_path = 'avatars/old.png';
        $user->save();
        $user->microposts()->create(['content' => 'テスト投稿']);

        $this->actingAs($user)->from('/users/'.$user->id)
            ->put(route('users.avatar.update', $user->id), ['avatar' => $this->image()])
            ->assertRedirect('/users/'.$user->id)
            ->assertSessionHas('success', 'プロフィール画像を更新しました。');

        $user->refresh();
        Storage::disk('public')->assertExists($user->avatar_path);
        Storage::disk('public')->assertMissing('avatars/old.png');
        $url = Storage::disk('public')->url($user->avatar_path);
        $this->assertSame('/storage/'.$user->avatar_path, $url);
        foreach (['/', '/users', '/users/'.$user->id] as $page) {
            $this->get($page)->assertOk()->assertSee($url, false);
        }
    }

    public function test_guests_and_other_users_cannot_change_avatar(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $this->put(route('users.avatar.update', $user->id), ['avatar' => $this->image()])
            ->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create())
            ->put(route('users.avatar.update', $user->id), ['avatar' => $this->image()])
            ->assertForbidden();
        $this->assertNull($user->fresh()->avatar_path);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public function test_invalid_and_large_uploads_keep_existing_avatar(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $user->avatar_path = 'avatars/old.png';
        $user->save();
        Storage::disk('public')->put($user->avatar_path, 'existing');
        $this->actingAs($user)->from('/users/'.$user->id);

        foreach ([
            [],
            ['avatar' => UploadedFile::fake()->createWithContent('invalid.png', 'not an image')->mimeType('text/plain')],
            ['avatar' => UploadedFile::fake()->createWithContent('avatar.svg', '<svg xmlns="http://www.w3.org/2000/svg"/>')],
            ['avatar' => $this->image()->size(2049)],
        ] as $data) {
            $this->put(route('users.avatar.update', $user->id), $data)->assertSessionHasErrors('avatar');
        }
        $this->assertSame('avatars/old.png', $user->fresh()->avatar_path);
        Storage::disk('public')->assertExists('avatars/old.png');
        $this->assertCount(1, Storage::disk('public')->allFiles());
    }

    public function test_gravatar_is_used_when_no_upload_exists(): void
    {
        $user = User::factory()->create();
        $this->assertStringContainsString('gravatar.com/avatar/', $user->avatarUrl());
        $this->actingAs($user)->get('/users/'.$user->id)
            ->assertSee('gravatar.com/avatar/', false)->assertDontSee('images/no-image.svg', false)
            ->assertSee('object-cover')->assertSee('object-center');
    }
}
