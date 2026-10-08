<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1>
                <a href="/" class="flex items-center gap-2.5" aria-label="Home">

                    {{-- ロゴ --}}
                    <span class="flex size-9 items-center justify-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="size-8">

                            {{-- 4分割タイル --}}
                            <rect x="4" y="4" width="10" height="10" rx="2" />
                            <rect x="17" y="4" width="10" height="10" rx="2" />
                            <rect x="4" y="17" width="10" height="10" rx="2" />

                            {{-- 右下だけ塗りつぶし --}}
                            <rect x="17" y="17" width="10" height="10" rx="2" fill="currentColor" />

                            {{-- 右下から飛び出すペン --}}
                            <path d="M22 29.5l1-4 7.5-7.5a2.1 2.1 0 0 1 3 3L26 28.5l-4 1Z" fill="var(--color-neutral)"
                                stroke="currentColor" />

                            {{-- ペンの境界線 --}}
                            <path d="m28.5 20 3 3" />
                        </svg>
                    </span>

                    {{-- アプリ名 --}}
                    <span class="text-xl font-black tracking-tight">
                        Micro<span class="text-primary">Posts</span>
                    </span>
                </a>
            </h1>
        </div>

        <div class="flex-none">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <ul class="menu hidden lg:menu-horizontal">
                    @include('commons.link_items')
                </ul>
                <ul class="menu lg:hidden">
                    <li>
                        <details class="dropdown dropdown-end">
                            <summary>
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Guest
                                @endauth
                            </summary>
                            <ul class="menu dropdown-content shadow rounded-t-none bg-base-100 w-52 p-2 link-neutral">
                                @include('commons.link_items')
                            </ul>
                        </details>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
</header>
