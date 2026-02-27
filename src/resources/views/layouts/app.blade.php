<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>フリマアプリ</title>

  {{-- 共通CSS --}}
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  {{-- 各ページCSS --}}
  @yield('css')
</head>
<body>

<header class="header">
  <div class="header__inner">
    <div class="header__logo">CT COACHTECH</div>

    <form class="header__search" action="{{ url()->current() }}" method="GET">
      <input class="header__search-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
    </form>

    <nav class="header__nav">
      <a class="header__link" href="#">ログアウト</a>
      <a class="header__link" href="#">マイページ</a>
      <a class="header__btn" href="#">出品</a>
    </nav>
  </div>
</header>

<main class="main">
  @yield('content')
</main>

</body>
</html>
