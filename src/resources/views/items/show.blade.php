@extends('layouts.app')

@section('content')

<div class="detail-container">

    <div class="detail-left">
        <div class="detail-image">
            商品画像
        </div>
    </div>

    <div class="detail-right">

        <h2 class="detail-title">{{ $item->name }}</h2>
        <p class="brand">{{ $item->brand_name }}</p>

        <p class="price">¥{{ number_format($item->price) }} <span>(税込)</span></p>

        @if($item->is_sold)
            <p class="sold-text">SOLD</p>
        @else
            <button class="buy-button">購入手続きへ</button>
        @endif

        <h3>商品説明</h3>
        <p>{{ $item->description }}</p>

        <h3>商品の情報</h3>

        <p><strong>カテゴリ：</strong>
            @foreach($item->categories as $category)
                <span class="category">{{ $category->name }}</span>
            @endforeach
        </p>

        <p><strong>商品の状態：</strong> {{ $item->condition }}</p>

        <h3>出品者</h3>
        <p>{{ $item->user->name }}</p>

    </div>

</div>

@endsection
