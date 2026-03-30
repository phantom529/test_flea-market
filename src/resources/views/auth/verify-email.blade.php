@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="verify-container">
    <p class="verify-message">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

    <a href="{{ route('verification.notice') }}" class="btn-verify">認証はこちらから</a>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="link-resend" style="background:none;border:none;cursor:pointer;">
            認証メールを再送する
        </button>
    </form>
</div>
@endsection
