<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    @section('top_css')
    @stack('show_css')
    <title>@yield('title')</title>
</head>

<body>
    <header>
        <div class="header_all">
            <div class="header_buttons">
                <h1>HOME</h1>
                <ul>
                    <li>検索</li>
                    <li>カート</li>
                    <li>ログイン</li>
                </ul>
            </div>
            <div class="header_ul">
                <ul>
                    <li>新着</li>
                    <li>年齢別</li>
                    <li>販売</li>
                    <li>特集</li>
                    <li>レビュー</li>
                </ul>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <ul>
            <li>新着</li>
            <li>年齢別</li>
            <li>販売</li>
            <li>特集</li>
            <li>レビュー</li>
        </ul>
    </footer>
</body>
</html>
