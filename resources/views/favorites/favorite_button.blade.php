<div class="flex items-center gap-1">
    @if (Auth::user()->is_favoriting($micropost->id))
        {{-- お気に入り解除 --}}
        <form method="POST" action="{{ route('micropost.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-ghost btn-circle btn-sm text-error hover:bg-error/10" title="お気に入り解除"
                aria-label="お気に入りを解除">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path d="M11.645 20.91a.75.75 0 0 0 .71 0C17.84 17.74 21 14.28 21 10.125
            21 7.057 18.53 4.5 15.375 4.5
            13.65 4.5 12.15 5.29 12 6.375
            11.85 5.29 10.35 4.5 8.625 4.5
            5.47 4.5 3 7.057 3 10.125
            3 14.28 6.16 17.74 11.645 20.91Z" />
                </svg>
            </button>
        </form>
    @else
        {{-- お気に入り --}}
        <form method="POST" action="{{ route('micropost.favorite', $micropost->id) }}">
            @csrf
            <button type="submit"
                class="btn btn-ghost btn-circle btn-sm text-base-content/50 hover:text-error hover:bg-error/10"
                title="お気に入り" aria-label="お気に入りに追加">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5
            -1.935 0-3.597 1.126-4.312 2.733
            -.715-1.607-2.377-2.733-4.313-2.733
            C5.1 3.75 3 5.765 3 8.25
            c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </form>
    @endif

    <span class="text-sm text-base-content/60">
        {{ $micropost->favorite_users()->count() }}
    </span>
</div>
