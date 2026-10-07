@auth
    {{-- ユーザー一覧ページへのリンク --}}
    <li>
        <a class="link link-hover flex items-center gap-2" href="{{ route('users.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="size-5">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span>Users</span>
        </a>
    </li>

    {{-- ユーザー詳細ページへのリンク --}}
    <li>
        <a class="link link-hover flex items-center gap-2" href="{{ route('users.show', Auth::user()->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 21a8 8 0 0 1 16 0" />
            </svg>
            <span>{{ Auth::user()->name }}'s profile</span>
        </a>
    </li>

    {{-- お気に入り一覧ページへのリンク --}}
    <li>
        <a class="link link-hover flex items-center gap-2" href="{{ route('users.favorites', Auth::user()->id) }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5
                                -1.935 0-3.597 1.126-4.312 2.733
                                -.715-1.607-2.377-2.733-4.313-2.733
                                C5.1 3.75 3 5.765 3 8.25
                                c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
            <span>Favorites</span>
        </a>
    </li>

    <li>
        <div class="divider lg:hidden"></div>
    </li>

    {{-- ログアウト --}}
    <li>
        <a class="link link-hover flex items-center gap-2 text-error" href="#"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                <path d="M10 17l5-5-5-5" />
                <path d="M15 12H3" />
                <path d="M21 19V5a2 2 0 0 0-2-2h-6" />
            </svg>
            <span>Logout</span>
        </a>
    </li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li>
        <a class="link link-hover" href="{{ route('register') }}">
            Signup
        </a>
    </li>

    <li>
        <div class="divider lg:hidden"></div>
    </li>

    {{-- ログインページへのリンク --}}
    <li>
        <a class="link link-hover" href="{{ route('login') }}">
            Login
        </a>
    </li>
@endauth
