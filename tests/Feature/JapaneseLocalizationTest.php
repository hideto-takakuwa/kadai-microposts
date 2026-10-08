<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Volt\Volt;
use Tests\TestCase;

class JapaneseLocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_auth_screens_use_japanese(): void
    {
        $this->assertSame('ja', app()->getLocale());

        foreach ([
            '/login' => 'ログイン | MicroPosts',
            '/register' => '新規登録 | MicroPosts',
            '/forgot-password' => 'パスワードの再設定 | MicroPosts',
        ] as $url => $title) {
            $this->get($url)->assertOk()->assertSee($title)->assertSee('メールアドレス');
        }

        $this->get('/')->assertOk()->assertSee('新規登録')->assertDontSee('Sign up');
    }

    public function test_login_errors_and_throttling_use_japanese(): void
    {
        $user = User::factory()->create();
        $component = Volt::test('auth.login')->set('email', $user->email)->set('password', 'wrong');
        $component->call('login')->assertHasErrors('email')
            ->assertSee('メールアドレスまたはパスワードが正しくありません。');

        $key = strtolower($user->email).'|127.0.0.1';
        for ($i = 0; $i < 5; $i++) {
            RateLimiter::hit($key);
        }
        $component->call('login')->assertSee('ログインの試行回数が多すぎます。');
        RateLimiter::clear($key);
    }

    public function test_registration_validation_uses_japanese_field_names(): void
    {
        $user = User::factory()->create();
        Volt::test('auth.register')->set('email', $user->email)->set('password', 'short')
            ->set('password_confirmation', 'different')->call('register')
            ->assertSee('ユーザー名を入力してください。')
            ->assertSee('このメールアドレスはすでに登録されています。')
            ->assertSee('パスワードと確認用の入力が一致しません。');

        Volt::test('auth.register')->set('name', 'テスト')->set('email', 'test@example.com')
            ->set('password', 'short')->set('password_confirmation', 'short')->call('register')
            ->assertSee('パスワードは8文字以上で入力してください。');
    }

    public function test_post_validation_and_success_notices_are_shown_in_the_shared_area(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->from('/')->post('/microposts', ['content' => ''])
            ->assertSessionHasErrors(['content' => '投稿内容を入力してください。']);
        $this->get('/')->assertSee('投稿内容を入力してください。')->assertSee('role="alert"', false);

        $this->from('/')->post('/microposts', ['content' => str_repeat('あ', 256)])
            ->assertSessionHasErrors(['content' => '投稿内容は255文字以内で入力してください。']);

        $this->from('/')->post('/microposts', ['content' => '日本語の投稿'])
            ->assertRedirect('/')->assertSessionHas('success', '投稿しました。');
        $this->get('/')->assertSee('投稿しました。')->assertSee('alert-success')->assertSee('日本語の投稿');

        $post = $user->microposts()->firstOrFail();
        $this->from('/')->delete('/microposts/'.$post->id)
            ->assertSessionHas('success', '投稿を削除しました。');
        $this->get('/')->assertSee('投稿を削除しました。')->assertDontSee('日本語の投稿');
        $this->assertDatabaseMissing('microposts', ['id' => $post->id]);
    }

    public function test_unauthorized_deletion_shows_a_japanese_error_and_keeps_the_post(): void
    {
        $author = User::factory()->create();
        $post = $author->microposts()->create(['content' => '他の人の投稿']);
        $this->actingAs(User::factory()->create())->from('/')->delete('/microposts/'.$post->id)
            ->assertSessionHasErrors(['delete' => 'この投稿を削除する権限がありません。']);
        $this->get('/')->assertSee('この投稿を削除する権限がありません。');
        $this->assertDatabaseHas('microposts', ['id' => $post->id]);
    }

    public function test_user_lists_and_pagination_use_japanese(): void
    {
        $user = User::factory()->create();
        $others = User::factory()->count(11)->create();
        $user->follow($others->first()->id);
        $this->actingAs($user)->get('/users')->assertOk()
            ->assertSee('フォロー中')->assertSee('フォロワー')->assertSee('プロフィールを見る')
            ->assertSee('件中、')->assertSee('件を表示')->assertSee('ページ送り');
        $this->get('/users/'.$user->id)->assertOk()->assertSee('お気に入り')->assertDontSee('<span>Posts</span>', false);
        $this->get('/users/'.$user->id.'/followings')->assertOk()->assertSee('フォロワー');
        $this->get('/users/'.$user->id.'/followers')->assertOk();
        $this->get('/users/'.$user->id.'/favorites')->assertOk();
    }

    public function test_auth_notification_emails_use_japanese_including_the_footer(): void
    {
        $user = User::factory()->create();
        foreach ([new ResetPassword('test-token'), new VerifyEmail] as $notification) {
            $mail = $notification->toMail($user);
            $this->assertMatchesRegularExpression('/[ぁ-んァ-ヶ一-龯]/u', $mail->subject);
            $html = (string) $mail->render();
            $this->assertStringContainsString('こんにちは。', $html);
            $this->assertStringContainsString('ボタンを押せない場合', $html);
            $this->assertStringContainsString('無断転載を禁じます。', $html);
            $this->assertStringNotContainsString('Regards,', $html);
            $this->assertStringNotContainsString('Laravel', $html);
        }
    }

    public function test_missing_page_and_other_error_views_use_japanese(): void
    {
        config(['app.debug' => false]);
        $this->get('/missing-page')->assertNotFound()->assertSee('ページが見つかりません');
        foreach ([401, 402, 403, 404, 419, 429, 500, 503] as $code) {
            $html = view('errors.'.$code)->render();
            $this->assertStringContainsString('ホームに戻る', $html);
            $this->assertStringNotContainsString('Server Error', $html);
        }
    }
}
