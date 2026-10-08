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
                                <x-user-avatar :user="$user" />
                            </div>
                        </div>
                        <a href="{{ route('users.show', $user->id) }}"
                            class="min-w-0 break-words font-semibold link link-hover text-info">
                            {{ $user->name }}
                        </a>
                    </div>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-ghost btn-sm mt-3 w-full">
                        自分のプロフィール
                    </a>
                </div>
            </aside>
            <div class="mt-4 sm:col-span-2">
                <h2 class="text-2xl font-bold">タイムライン</h2>
                <p class="mt-1 text-sm text-base-content/60">
                    フォロー中の人たちの近況をチェック
                </p>
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            </div>
        </div>
    @else
        <section class="overflow-hidden rounded-2xl border border-base-300 bg-base-100 shadow-sm">
            <div class="grid min-h-[420px] items-center gap-8 px-6 py-12 md:grid-cols-2 md:px-12">

                {{-- 左側：サービス紹介 --}}
                <div>
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex size-12 items-center justify-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="size-11">

                                {{-- 4分割タイル --}}
                                <rect x="4" y="4" width="10" height="10" rx="2" />
                                <rect x="17" y="4" width="10" height="10" rx="2" />
                                <rect x="4" y="17" width="10" height="10" rx="2" />

                                {{-- 右下だけ塗りつぶし --}}
                                <rect x="17" y="17" width="10" height="10" rx="2" fill="currentColor" />

                                {{-- ペン --}}
                                <path d="M22 29.5l1-4 7.5-7.5a2.1 2.1 0 0 1 3 3L26 28.5l-4 1Z" fill="var(--color-base-100)"
                                    stroke="currentColor" />

                                <path d="m28.5 20 3 3" />
                            </svg>
                        </span>

                        <span class="text-3xl font-black tracking-tight">
                            Micro<span class="text-primary">Posts</span>
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold leading-tight md:text-4xl">
                        気軽に投稿して、<br class="hidden sm:block">
                        つながろう。
                    </h1>

                    <p class="mt-4 max-w-lg text-base leading-relaxed text-base-content/60">
                        短い投稿をシェアしたり、気になるユーザーをフォローしたり、
                        お気に入りの投稿を保存したりできるシンプルなSNSです。
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-full px-7">
                            新規登録
                        </a>

                        <a href="{{ route('login') }}" class="btn btn-outline rounded-full px-7">
                            ログイン
                        </a>
                    </div>
                </div>

                {{-- 右側：機能紹介 --}}
                <div class="grid gap-3">
                    <div class="rounded-xl bg-base-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold">投稿</p>
                                <p class="text-sm text-base-content/60">
                                    今感じていることを気軽に投稿
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl bg-base-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="m16 11 2 2 4-4" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold">フォロー</p>
                                <p class="text-sm text-base-content/60">
                                    気になるユーザーをフォロー
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl bg-base-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5
                                                                    -1.935 0-3.597 1.126-4.312 2.733
                                                                    -.715-1.607-2.377-2.733-4.313-2.733
                                                                    C5.1 3.75 3 5.765 3 8.25
                                                                    c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            </div>

                            <div>
                                <p class="font-semibold">お気に入り</p>
                                <p class="text-sm text-base-content/60">
                                    気に入った投稿をお気に入り保存
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
@endsection
