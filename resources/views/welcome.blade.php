@extends('layouts.app')

@section('content')
    @auth
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class="mt-4">
                {{-- ホーム用のユーザー情報 --}}
                <div class="rounded-xl border border-base-300 bg-base-100 p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="avatar shrink-0">
                            <div class="w-12 rounded-full">
                                <img src="{{ Gravatar::get($user->email) }}" alt="" />
                            </div>
                        </div>
                        <a href="{{ route('users.show', $user->id) }}"
                            class="min-w-0 break-words font-semibold link link-hover text-info">
                            {{ $user->name }}
                        </a>
                    </div>
                    <a href="{{ route('users.show', $user->id) }}"
                        class="btn btn-ghost btn-sm mt-3 w-full">
                        View my profile
                    </a>
                </div>
            </aside>
            <div class="mt-4 sm:col-span-2">
                <h2 class="text-2xl font-bold">Home</h2>
                <p class="mt-1 text-sm text-base-content/60">
                    フォロー中のユーザーとあなたの最新の投稿
                </p>
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            </div>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Microposts</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-neutral btn-lg" href="{{ route('register') }}">Sign up now!</a>
                </div>
            </div>
        </div>
    @endauth
@endsection
