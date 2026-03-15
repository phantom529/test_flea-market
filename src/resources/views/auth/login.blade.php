@extends('layouts.app')

@section('title', 'ログイン')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth">
    <h2 class="auth__title">ログイン</h2>

    <form method="POST" action="{{ route('login') }}" class="auth__form">
        @csrf

        <div class="auth__group">
            <label class="auth__label">メールアドレス</label>
            <input
                type="email"
                name="email"
                class="auth__input"
                value="{{ old('email') }}"
                autofocus
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

        <button type="submit" class="auth__button">ログインする</button>
    </form>

    <p class="auth__link">
        <a href="{{ route('register') }}">会員登録はこちら</a>
    </p>
</div>
@endsection