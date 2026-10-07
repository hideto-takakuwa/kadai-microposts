<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1>
                <a class="btn btn-ghost text-xl gap-2" href="/" aria-label="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5">
                        <path d="M3 11.5 12 4l9 7.5" />
                        <path d="M5 10v10h14V10" />
                        <path d="M9 20v-6h6v6" />
                    </svg>

                    <span>Microposts</span>
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
