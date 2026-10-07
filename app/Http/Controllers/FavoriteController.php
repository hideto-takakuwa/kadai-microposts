<?php

namespace App\Http\Controllers;

use App\Models\Micropost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * ポストをお気に入りするアクション。
     *
     * @param  $id  ポストのid
     * @return \Illuminate\Http\Response
     */
    public function store(string $id)
    {
        // 対象の投稿が存在するか確認
        $micropost = Micropost::findOrFail($id);

        // 認証済みユーザー（閲覧者）が、 idのポストをお気に入りする
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $user->favorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * ポストのお気に入り解除するアクション。
     *
     * @param  $id  ポストのid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // 対象の投稿が存在するか確認
        $micropost = Micropost::findOrFail($id);
        
        // 認証済みユーザー（閲覧者）が、 idのポストをお気に入り解除する
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $user->unfavorite(intval($id));
        // 前のURLへリダイレクトさせる
        return back();
    }
}
