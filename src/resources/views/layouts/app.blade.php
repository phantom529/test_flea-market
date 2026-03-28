<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'coachtechフリマ')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('css')
</head>
<body>
{{-- ヘッダー --}}
<header class="header">
  <div class="header__inner">
    <a href="/" class="header__logo">
      <img src="{{ asset('images/logo.png') }}" alt="COACHTECH">
    </a>
    <form class="header__search" action="/" method="GET">
      <input
        type="text"
        name="keyword"
        class="header__search-input"
        placeholder="なにをお探しですか？"
        value="{{ request('keyword') }}">
      <button type="submit" class="header__search-btn">検索</button>
    </form>
    <nav class="header__nav">
      @auth
        <form action="/logout" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="header__nav-btn">ログアウト</button>
        </form>
        <a href="/mypage" class="header__nav-link">マイページ</a>
      @else
        <a href="/login" class="header__nav-link">ログイン</a>
        <a href="/register" class="header__nav-link">会員登録</a>
      @endauth
      <a href="/sell" class="header__nav-sell-btn">出品</a>
    </nav>
  </div>
</header>
<main>
  @yield('content')
</main>
<footer class="footer">
  <div class="footer__inner">
    <p class="footer__copy">&copy; coachtech</p>
  </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
