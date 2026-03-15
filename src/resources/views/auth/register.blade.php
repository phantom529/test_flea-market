@extends('layouts.app')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth">
    <h2 class="auth__title">会員登録</h2>

    <form method="POST" action="{{ route('register') }}" class="auth__form">
        @csrf

        <div class="auth__group">
            <label class="auth__label">ユーザー名</label>
            <input
                type="text"
                name="name"
                class="auth__input"
                value="{{ old('name') }}"
            >
            @error('name')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label class="auth__label">メールアドレス</label>
            <input
                type="email"
                name="email"
                class="auth__input"
                value="{{ old('email') }}"
            >
            @error('email')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label class="auth__label">パスワード</label>
            <input
                type="password"
                name="password"
                class="auth__input"
            >
            @error('password')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label class="auth__label">確認用パスワード</label>
            <input
                type="password"
                name="password_confirmation"
                class="auth__input"
            >
            @error('password_confirmation')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth__button">登録する</button>
    </form>

    <p class="auth__link">
        <a href="{{ route('login') }}">ログインはこちら</a>
    </p>
</div>
@endsection