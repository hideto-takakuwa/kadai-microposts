<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
    <figure class="aspect-square">
        <x-user-avatar :user="$user" :size="500" />
    </figure>
</div>

@if (Auth::id() === $user->id)
    <form method="POST" action="{{ route('users.avatar.update', $user->id) }}" enctype="multipart/form-data" class="mt-3">
        @csrf
        @method('PUT')
        <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp" class="hidden"
            aria-label="プロフィール画像を選択" onchange="if (this.files.length) this.form.requestSubmit();" />
        <button type="button" class="btn btn-outline btn-sm rounded-full normal-case w-full gap-2"
            onclick="this.form.querySelector('input[type=file]').click();">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4" aria-hidden="true">
                <path d="M14 4h-4l-2 3H4a2 2 0 0 0-2 2v11h20V9a2 2 0 0 0-2-2h-4Z" />
                <circle cx="12" cy="13" r="4" />
            </svg>
            画像を変更
        </button>
        <p class="mt-2 text-center text-xs text-base-content/50">JPEG・PNG・WebP／2MBまで</p>
    </form>
@else
    {{-- フォロー／アンフォローボタン --}}
    @include('user_follow.follow_button', ['fullWidth' => true])
@endif
