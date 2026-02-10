<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<header class="header">
    <h1 class="header__logo">CT COACHTECH</h1>
</header>

<main class="auth">
    <h1 class="auth__title">ログイン</h1>

    <form class="auth__form" method="POST" action="{{ route('login') }}" >
        @csrf

        <div class="auth__group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label>パスワード</label>
            <input type="password" name="password" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth__button">ログインする</button>
    </form>

    <p class="register__link">
        <a href="{{ route('register') }}">会員登録はこちら</a>
    </p>
</main>
</body>
</html>