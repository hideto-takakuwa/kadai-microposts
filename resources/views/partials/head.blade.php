<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />

@php
    $pageTitle =
        $title ??
        match (request()->route()?->getName()) {
            'login' => 'ログイン',
            'register' => '新規登録',
            'password.request', 'password.reset' => 'パスワードの再設定',
            'password.confirm' => 'パスワードの確認',
            'verification.notice' => 'メールアドレスの確認',
            default => null,
        };
@endphp
<title>{{ $pageTitle ? $pageTitle . ' | ' : '' }}{{ config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
