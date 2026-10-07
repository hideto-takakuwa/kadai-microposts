<div class="mt-4">
    @if (isset($microposts))
        <ul class="list-none space-y-4">
            @foreach ($microposts as $micropost)
                <li class="flex items-start gap-3 rounded-xl border border-base-300 bg-base-100 p-4 shadow-sm">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar shrink-0">
                        <div class="w-12 rounded-full">
                            <img src="{{ Gravatar::get($micropost->user->email) }}" alt="" />
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            <a class="link link-hover font-semibold text-info"
                                href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                            <span
                                class="text-xs text-base-content/60">{{ $micropost->created_at->format('Y/m/d H:i') }}</span>
                        </div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mt-2 leading-relaxed [overflow-wrap:anywhere]">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        <div class="flex items-center gap-1">
                            {{-- お気に入り／お気に入り解除ボタン --}}
                            @include('favorites.favorite_button')
                            @if (Auth::id() == $micropost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-ghost btn-circle btn-sm text-error hover:bg-error/10"
                                        onclick="return confirm('この投稿を削除しますか？\nこの操作は取り消せません。')" title="投稿を削除"
                                        aria-label="投稿を削除">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4h8v2" />
                                            <path d="M19 6l-1 14H6L5 6" />
                                            <path d="M10 11v5" />
                                            <path d="M14 11v5" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>
