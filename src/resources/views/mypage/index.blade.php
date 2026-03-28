@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">

    {{-- プロフィールヘッダー --}}
    <div class="profile-header">
        <div class="profile-avatar">
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" class="profile-avatar-img">
            @else
                <img src="{{ asset('images/default_avatar.png') }}" alt="プロフィール画像" class="profile-avatar-img">
            @endif
        </div>
        <p class="profile-username">{{ $user->name }}</p>
        <a href="/mypage/profile" class="btn-edit-profile">プロフィールを編集</a>
    </div>

    {{-- タブ --}}
    <div class="tab-bar">
        <button class="tab-item tab-item--active" id="tab-sell" onclick="switchTab('sell')">出品した商品</button>
        <button class="tab-item" id="tab-buy" onclick="switchTab('buy')">購入した商品</button>
    </div>

    {{-- 出品した商品 --}}
    <div class="product-grid" id="panel-sell">
        @forelse($soldItems as $item)
        <a class="product-card" href="{{ route('items.show', $item->id) }}">
            <div class="product-image-placeholder">
                <img src="{{ $item->items_image }}" alt="{{ $item->name }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <p class="product-name">{{ $item->name }}</p>
        </a>
        @empty
        <p>出品した商品はありません。</p>
        @endforelse
    </div>

    {{-- 購入した商品 --}}
    <div class="product-grid product-grid--hidden" id="panel-buy">
        @forelse($boughtItems as $item)
        <a class="product-card" href="{{ route('items.show', $item->id) }}">
            <div class="product-image-placeholder">
                <img src="{{ $item->items_image }}" alt="{{ $item->name }}" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <p class="product-name">{{ $item->name }}</p>
        </a>
        @empty
        <p>購入した商品はありません。</p>
        @endforelse
    </div>

</div>

<script>
function switchTab(tab) {
    document.getElementById('tab-sell').classList.remove('tab-item--active');
    document.getElementById('tab-buy').classList.remove('tab-item--active');
    document.getElementById('panel-sell').classList.add('product-grid--hidden');
    document.getElementById('panel-buy').classList.add('product-grid--hidden');

    document.getElementById('tab-' + tab).classList.add('tab-item--active');
    document.getElementById('panel-' + tab).classList.remove('product-grid--hidden');
}
</script>
@endsection
