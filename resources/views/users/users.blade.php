@if (isset($users))
    <ul class="space-y-3">
        @foreach ($users as $user)
            <li class="flex flex-col gap-3 rounded-xl border border-base-300 bg-base-100 p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="avatar shrink-0">
                        <div class="w-12 rounded-full">
                            <img src="{{ Gravatar::get($user->email) }}" alt="" />
                        </div>
                    </div>

                    <div class="min-w-0">
                        <a class="break-words font-semibold link link-hover text-info" href="{{ route('users.show', $user->id) }}">
                            {{ $user->name }}
                        </a>

                        <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm">
                            <a href="{{ route('users.followings', $user->id) }}" class="link link-hover whitespace-nowrap">
                                <span class="text-base-content/60">フォロー中</span>
                                <span class="font-semibold tabular-nums text-base-content">{{ $user->followings_count }}人</span>
                            </a>

                            <a href="{{ route('users.followers', $user->id) }}" class="link link-hover whitespace-nowrap">
                                <span class="text-base-content/60">フォロワー</span>
                                <span class="font-semibold tabular-nums text-base-content">{{ $user->followers_count }}人</span>
                            </a>
                        </div>

                        <div class="mt-1 text-xs text-base-content/50">
                            登録日: {{ $user->created_at->format('Y/m/d') }}
                        </div>
                    </div>
                </div>

                <div class="flex shrink-0 flex-wrap items-center justify-end gap-2">
                    {{-- 全ユーザー一覧のときだけフォロー／アンフォローボタン表示 --}}
                    @if (Request::routeIs('users.index'))
                        @include('user_follow.follow_button')
                    @endif

                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-ghost btn-sm">
                        プロフィールを見る
                    </a>
                </div>
            </li>
        @endforeach
    </ul>

    {{ $users->links() }}
@endif
