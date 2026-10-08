<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2.5 font-medium" wire:navigate>

                {{-- ロゴ --}}
                <span class="flex size-11 items-center justify-center text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" fill="none" stroke="currentColor"
                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="size-10">

                        {{-- 4分割タイル --}}
                        <rect x="4" y="4" width="10" height="10" rx="2" />
                        <rect x="17" y="4" width="10" height="10" rx="2" />
                        <rect x="4" y="17" width="10" height="10" rx="2" />

                        {{-- 右下だけ塗りつぶし --}}
                        <rect x="17" y="17" width="10" height="10" rx="2" fill="currentColor" />

                        {{-- 右下から飛び出すペン --}}
                        <path d="M22 29.5l1-4 7.5-7.5a2.1 2.1 0 0 1 3 3L26 28.5l-4 1Z" fill="var(--color-base-100)"
                            stroke="currentColor" />

                        {{-- ペンの境界線 --}}
                        <path d="m28.5 20 3 3" />
                    </svg>
                </span>

                {{-- アプリ名 --}}
                <span class="text-2xl font-black tracking-tight">
                    Micro<span class="text-primary">Posts</span>
                </span>

                <span class="sr-only">
                    {{ config('app.name', 'MicroPosts') }}
                </span>
            </a>
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
