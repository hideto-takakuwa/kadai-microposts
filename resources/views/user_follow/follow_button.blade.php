@php
    $fullWidth = $fullWidth ?? false;
@endphp

@if (Auth::id() != $user->id)
    @if (Auth::user()->is_following($user->id))
        <form method="POST" action="{{ route('user.unfollow', $user->id) }}" class="{{ $fullWidth ? 'w-full' : '' }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="btn btn-outline btn-sm rounded-full normal-case group hover:border-error hover:bg-error/10
                    {{ $fullWidth ? 'w-full' : 'min-w-28' }}"
                onclick="return confirm('{{ $user->name }} さんのフォローを外しますか？')">

                <span class="group-hover:hidden">
                    フォロー中
                </span>

                <span class="hidden text-error group-hover:inline">
                    フォロー解除
                </span>
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('user.follow', $user->id) }}" class="{{ $fullWidth ? 'w-full' : '' }}">
            @csrf

            <button type="submit"
                class="btn btn-primary btn-sm rounded-full normal-case
                    {{ $fullWidth ? 'w-full' : 'min-w-28' }}">
                フォローする
            </button>
        </form>
    @endif
@endif
