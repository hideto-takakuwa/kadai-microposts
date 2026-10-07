@if (isset($users))
    <ul class="space-y-3">
        @foreach ($users as $user)
            <li class="flex items-center justify-between rounded-xl border border-base-300 bg-base-100 p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="{{ Gravatar::get($user->email) }}" alt="" />
                        </div>
                    </div>

                    <div>
                        <a class="font-semibold link link-hover text-info" href="{{ route('users.show', $user->id) }}">
                            {{ $user->name }}
                        </a>

                        <div class="mt-1 text-xs text-base-content/50">
                            登録日: {{ $user->created_at->format('Y/m/d') }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    {{-- 全ユーザー一覧のときだけフォロー／アンフォローボタン表示 --}}
                    @if (Request::routeIs('users.index'))
                        @include('user_follow.follow_button')
                    @endif

                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-ghost btn-sm">
                        View profile
                    </a>
                </div>
            </li>
        @endforeach
    </ul>

    {{ $users->links() }}
@endif
