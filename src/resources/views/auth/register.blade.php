<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<header class="header">
    <div class="header__logo">CT COACHTECH</div>
</header>

<main class="auth">
    <h1 class="auth__title">会員登録</h1>

    <form method="POST" action="{{ route('register') }}" class="auth__form">
        @csrf

        <div class="auth__group">
            <label>ユーザー名</label>
            <input type="text" name="name" required>
        </div>

        <div class="auth__group">
            <label>メールアドレス</label>
            <input type="email" name="email" required>
        </div>

        <div class="auth__group">
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>

        <div class="auth__group">
            <label>確認用パスワード</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button class="auth__button">登録する</button>
    </form>

    <p class="auth__link">
        <a href="{{ route('login') }}">ログインはこちら</a>
    </p>
</main>
</body>
</html>