<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | MicroPosts</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; background: #f8fafc; color: #1e293b; font-family: system-ui, sans-serif; }
        main { max-width: 40rem; padding: 2rem; text-align: center; }
        .code { color: #64748b; font-size: 3rem; font-weight: 700; margin: 0; }
        h1 { font-size: 1.5rem; }
        p { line-height: 1.8; }
        a { display: inline-block; margin-top: 1rem; color: #0369a1; }
    </style>
</head>
<body>
    <main>
        <p class="code">@yield('code')</p>
        <h1>@yield('title')</h1>
        <p>@yield('description')</p>
        <a href="{{ route('home') }}">ホームに戻る</a>
    </main>
</body>
</html>
