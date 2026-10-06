<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザー一覧ビューで表示
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function show(string $id)
    {
        // ユーザー詳細を取得
        $user = User::findOrFail($id);

        // ユーザー一覧ビューで表示
        return view('users.show', [
            'user' => $user
        ]);
    }
}
