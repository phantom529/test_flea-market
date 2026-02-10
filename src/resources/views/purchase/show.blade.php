@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">

  <!-- 左側：商品情報 -->
  <div class="purchase-left">
    <div class="item">
      <div class="item-image">商品画像</div>

      <div class="item-info">
        <h2 class="item-name">{{ $item->name }}</h2>
        <p class="item-price">¥{{ number_format($item->price) }}</p>
      </div>
    </div>

    <!-- 支払い方法 -->
    <div class="section">
      <h3>支払い方法</h3>
      <select class="select">
        <option>選択してください</option>
        <option>コンビニ払い</option>
        <option>クレジットカード</option>
      </select>
    </div>

    <!-- 配送先 -->
    <div class="section">
      <h3>配送先 <span class="change">変更する</span></h3>
      <p>〒XXX-YYYY</p>
      <p>ここには住所と建物が入ります</p>
    </div>
  </div>

  <!-- 右側：購入ボタン -->
  <div class="purchase-right">
    <div class="summary">
      <div class="row">
        <span>商品代金</span>
        <span>¥{{ number_format($item->price) }}</span>
      </div>

      <div class="row">
        <span>支払い方法</span>
        <span>コンビニ払い</span>
      </div>
    </div>

    <!-- Stripeへ -->
    
    <form method="GET" action="/stripe/{{ $item->id }}">
    <button>購入する</button>
    </form>
  </div>

</div>
@endsection
