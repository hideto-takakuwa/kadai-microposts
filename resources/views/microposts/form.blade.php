@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('microposts.store') }}">
            @csrf

            <div class="form-control mt-4">
                <textarea rows="3" name="content" class="textarea textarea-bordered w-full resize-none text-base"
                    placeholder="What's happening?">{{ old('content') }}</textarea>
            </div>

            <div class="mt-3 flex justify-end">
                <button type="submit" class="btn btn-primary btn-sm gap-2 rounded-full px-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4">
                        <path d="m22 2-7 20-4-9-9-4Z" />
                        <path d="M22 2 11 13" />
                    </svg>

                    <span>Post</span>
                </button>
            </div>
        </form>
    </div>
@endif
