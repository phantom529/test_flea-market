@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">

    {{-- プロフィールヘッダー --}}
    <div class="profile-header">
        <div class="profile-avatar">
            {{-- プロフィール画像があれば表示、なければグレーの丸 --}}
            <img src="{{ asset('storage/profile_images/default.png') }}" alt="プロフィール画像" class="profile-avatar-img">
        </div>
        <p class="profile-username">ユーザー名</p>
        <a href="/mypage/profile" class="btn-edit-profile">プロフィールを編集</a>
    </div>

    {{-- タブ --}}
    <div class="tab-bar">
        <button class="tab-item tab-item--active" id="tab-sell" onclick="switchTab('sell')">出品した商品</button>
        <button class="tab-item" id="tab-buy" onclick="switchTab('buy')">購入した商品</button>
    </div>

    {{-- 出品した商品 --}}
    <div class="product-grid" id="panel-sell">
        {{-- 静的ダミー4件 --}}
        @for($i = 0; $i < 4; $i++)
        <div class="product-card">
            <div class="product-image-placeholder">商品画像</div>
            <p class="product-name">商品名</p>
        </div>
        @endfor
    </div>

    {{-- 購入した商品 --}}
    <div class="product-grid product-grid--hidden" id="panel-buy">
        @for($i = 0; $i < 2; $i++)
        <div class="product-card">
            <div class="product-image-placeholder">商品画像</div>
            <p class="product-name">商品名</p>
        </div>
        @endfor
    </div>

</div>

<script>
function switchTab(tab) {
    // タブ切り替え（静的確認用）
    document.getElementById('tab-sell').classList.remove('tab-item--active');
    document.getElementById('tab-buy').classList.remove('tab-item--active');
    document.getElementById('panel-sell').classList.add('product-grid--hidden');
    document.getElementById('panel-buy').classList.add('product-grid--hidden');

    document.getElementById('tab-' + tab).classList.add('tab-item--active');
    document.getElementById('panel-' + tab).classList.remove('product-grid--hidden');
}
</script>
@endsection