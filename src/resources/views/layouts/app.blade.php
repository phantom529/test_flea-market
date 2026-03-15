<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'coachtechフリマ')</title>

  {{-- テスト用：パスを直接確認 --}}
    <link rel="stylesheet" href="/css/app.css">

    @yield('css')

</head>

  {{-- 共通CSSの読み込み --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  {{-- 各ページごとに追加CSSを入れられる場所 --}}
  @yield('css')
</head>
<body>

{{-- ヘッダー --}}
<header class="header">
<div class="header__inner">

{{-- ロゴ --}}
  <a href="/" class="header__logo">
    <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH">
  </a>

  {{-- 検索フォーム --}}
    <form class="header__search" action="/" method="GET">
      <input
      type="text"
      name="keyword"
      class="header__search-input"
      placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
      >
      <button type="submit" class="header__search-btn">検索</button>
    </form>
  {{-- ナビゲーション --}}
  <nav class="header__nav">
    @auth
      {{-- ログイン中だけ表示 --}}
      <form action="/logout" method="POST" style="display:inline;">
        @csrf
      <button type="submit" class="header__nav-btn">ログアウト</button>
      </form>
      <a href="/mypage" class="header__nav-link">マイページ</a>
    @else
      {{-- 未ログイン時に表示 --}}
      <a href="/login" class="header__nav-link">ログイン</a>
      <a href="/register" class="header__nav-link">会員登録</a>
    @endauth

    <a href="/sell" class="header__nav-sell-btn">出品</a>
  </nav>
</div>
</header>

{{-- メインコンテンツ --}}
{{-- 各画面の中身 --}}
<main>
  @yield('content')
</main>

{{-- フッター --}}
<footer class="footer">
  <div class="footer__inner">
    <p class="footer__copy">&copy; coachtech</p>
  </div>
</footer>

{{-- 共通JS --}}
<script src="{{ asset('js/app.js') }}"></script>

{{-- ページごとに追加JSを入れられる場所 --}}
@yield('js')

</body>
</html>
