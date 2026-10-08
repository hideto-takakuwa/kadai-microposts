<div class="tabs tabs-lift">
    {{-- ユーザー詳細タブ --}}
    <a href="{{ route('users.show', $user->id) }}"
        class="tab grow gap-1.5 {{ Request::routeIs('users.show') ? 'tab-active' : '' }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="size-4">
            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z" />
        </svg>

        <span>Posts</span>

        <div class="badge badge-soft badge-primary badge-sm">
            {{ $user->microposts_count }}
        </div>
    </a>

    {{-- フォロー一覧タブ --}}
    <a href="{{ route('users.followings', $user->id) }}"
        class="tab grow gap-1.5 {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="m16 11 2 2 4-4" />
        </svg>

        <span>Followings</span>

        <div class="badge badge-soft badge-primary badge-sm">
            {{ $user->followings_count }}
        </div>
    </a>

    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}"
        class="tab grow gap-1.5 {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>

        <span>Followers</span>

        <div class="badge badge-soft badge-primary badge-sm">
            {{ $user->followers_count }}
        </div>
    </a>

    {{-- お気に入り一覧タブ --}}
    <a href="{{ route('users.favorites', $user->id) }}"
        class="tab grow gap-1.5 {{ Request::routeIs('users.favorites') ? 'tab-active' : '' }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
            <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5
                -1.935 0-3.597 1.126-4.312 2.733
                -.715-1.607-2.377-2.733-4.313-2.733
                C5.1 3.75 3 5.765 3 8.25
                c0 7.22 9 12 9 12s9-4.78 9-12Z" />
        </svg>

        <span>Favorites</span>

        <div class="badge badge-soft badge-primary badge-sm">
            {{ $user->favorites_count }}
        </div>
    </a>
</div>
