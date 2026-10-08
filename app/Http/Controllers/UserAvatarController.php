<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserAvatarController extends Controller
{
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = $request->user();
        abort_unless((string) $user->id === $id, 403);

        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'avatar.required' => 'プロフィール画像を選択してください。',
            'avatar.image' => '有効な画像ファイルを選択してください。',
            'avatar.mimes' => '画像はJPEG、PNG、WebP形式で選択してください。',
            'avatar.max' => '画像は2MB以内で選択してください。',
            'avatar.uploaded' => '画像をアップロードできませんでした。ファイルサイズを確認して再度お試しください。',
        ]);

        $path = $request->file('avatar')->store('avatars', 'public');
        if ($path === false) {
            return back()->withErrors(['avatar' => '画像を保存できませんでした。再度お試しください。']);
        }

        $previousPath = $user->avatar_path;
        try {
            $user->avatar_path = $path;
            $user->save();
        } catch (Throwable $exception) {
            Storage::disk('public')->delete($path);
            throw $exception;
        }

        if ($previousPath) {
            Storage::disk('public')->delete($previousPath);
        }

        return back()->with('success', 'プロフィール画像を更新しました。');
    }
}
