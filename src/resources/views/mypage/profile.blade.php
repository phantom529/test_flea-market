@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile-edit-container">
    <h1 class="profile-edit-title">プロフィール設定</h1>

    <form action="/mypage/profile" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- アバター --}}
        <div class="avatar-section">
            <div class="avatar-preview">
                <img src="{{ asset('storage/profile_images/default.png') }}" alt="プロフィール画像" class="avatar-img" id="avatar-preview-img">
            </div>
            <label for="profile_image" class="btn-select-image">画像を選択する</label>
            <input type="file" id="profile_image" name="profile_image" class="input-file-hidden" accept="image/*">
        </div>

        {{-- ユーザー名 --}}
        <div class="form-group">
            <label class="form-label" for="username">ユーザー名</label>
            <input type="text" id="username" name="username" class="form-input" value="">
        </div>

        {{-- 郵便番号 --}}
        <div class="form-group">
            <label class="form-label" for="postal_code">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" class="form-input" value="">
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label class="form-label" for="address">住所</label>
            <input type="text" id="address" name="address" class="form-input" value="">
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label class="form-label" for="building">建物名</label>
            <input type="text" id="building" name="building" class="form-input" value="">
        </div>

        <button type="submit" class="btn-update">更新する</button>
    </form>
</div>
@endsection