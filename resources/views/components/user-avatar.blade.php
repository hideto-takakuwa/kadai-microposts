@props(['user', 'size' => 80])

<img src="{{ $user->avatarUrl($size) }}" alt="{{ $user->name }}さんのプロフィール画像"
    {{ $attributes->merge(['class' => 'h-full w-full object-cover object-center']) }} />
