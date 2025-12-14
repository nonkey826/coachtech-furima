<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'COACHTECH')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div class="header-left">
            <span class="logo">COACHTECH</span>
        </div>

        <div class="header-center">
            <input
                type="text"
                class="search-input"
                placeholder="なにをお探しですか？"
            >
        </div>

        <nav class="header-right">
            @auth
                <a href="{{ route('items.create') }}" class="sell-btn">出品</a>
                <a href="#">マイページ</a>
                <a href="#">ログアウト</a>
            @else
                <a href="{{ route('login') }}">ログイン</a>
                <a href="{{ route('register') }}">登録</a>
            @endauth
        </nav>
    </div>
</header>

<main class="main">
    @yield('content')
</main>

</body>
</html>
