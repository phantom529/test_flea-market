@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">

    {{-- 左カラム --}}
    <div class="purchase-left">

        {{-- 商品情報 --}}
        <div class="item">
            <div class="item-image">
                @if ($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                @else
                    <span>商品画像</span>
                @endif
            </div>
            <div>
                <p class="item-name">{{ $item->name }}</p>
                <p class="item-price">¥ {{ number_format($item->price) }}</p>
            </div>
        </div>

        <hr>

        {{-- 支払い方法 --}}
        <div class="section">
            <h3>支払い方法</h3>
            <select class="select" id="payment-method" name="payment_method">
                <option value="">選択してください</option>
                <option value="convenience">コンビニ払い</option>
                <option value="card">カード支払い</option>
            </select>
        </div>

        <hr>

        {{-- 配送先 --}}
        <div class="section">
            <div class="delivery-header">
                <h3>配送先</h3>
                <a href="{{ route('purchase.address.edit', ['id' => $item->id]) }}" class="change">変更する</a>
            </div>

            @if ($postal_code || $address)
                <p>〒 {{ $postal_code }}</p>
                <p>{{ $address }}{{ $building_name }}</p>
            @else
                <p>住所が登録されていません</p>
            @endif
        </div>

        <hr>

    </div>{{-- ここが purchase-left の閉じタグ --}}

    {{-- 右カラム --}}
    <div class="purchase-right">
        <div class="summary">
            <div class="row">
                <span>商品代金</span>
                <span>¥ {{ number_format($item->price) }}</span>
            </div>
            <hr>
            <div class="row">
                <span>支払い方法</span>
                <span id="summary-payment">未選択</span>
            </div>
        </div>

        <form action="{{ route('purchase.store', ['id' => $item->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" id="hidden-payment-method">
            <button type="submit" class="buy-button">購入する</button>
        </form>
    </div>{{-- ここが purchase-right の閉じタグ --}}

</div>{{-- ここが purchase の閉じタグ --}}

<script>
    const select = document.getElementById('payment-method');
    const summaryPayment = document.getElementById('summary-payment');
    const hiddenPayment = document.getElementById('hidden-payment-method');

    const labels = {
        '': '未選択',
        'convenience': 'コンビニ払い',
        'card': 'カード支払い',
    };

    select.addEventListener('change', function () {
        summaryPayment.textContent = labels[this.value] || '未選択';
        hiddenPayment.value = this.value;
    });
</script>
@endsection
