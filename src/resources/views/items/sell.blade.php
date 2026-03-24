@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/sell.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h1 class="sell-title">商品の出品</h1>

    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-section">
            <p class="form-label">商品画像</p>
            <div class="image-upload-area">
                <label for="product_image" class="btn-select-image">画像を選択する</label>
                <input type="file" id="product_image" name="product_image" class="input-file-hidden" accept="image/*">
            </div>
        </div>

        {{-- 商品の詳細 --}}
        <div class="form-section">
            <h2 class="section-heading">商品の詳細</h2>

            {{-- カテゴリー --}}
            <div class="form-group">
                <p class="form-label">カテゴリー</p>
                <div class="category-tags">
                    @php
                        $categories = ['ファッション', '家電', 'インテリア', 'レディース', 'メンズ', 'コスメ', '本', 'ゲーム', 'スポーツ', 'キッチン', 'ハンドメイド', 'アクセサリー', 'おもちゃ', 'ベビー・キッズ'];
                    @endphp
                    @foreach($categories as $category)
                    <label class="category-tag">
                        <input type="checkbox" name="categories[]" value="{{ $category }}" class="category-checkbox">
                        <span class="category-tag-label">{{ $category }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- 商品の状態 --}}
            <div class="form-group">
                <p class="form-label">商品の状態</p>
                <div class="select-wrapper">
                    <select name="condition" class="form-select">
                        <option value="">選択してください</option>
                        <option value="良好">良好</option>
                        <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                        <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                        <option value="状態が悪い">状態が悪い</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- 商品名と説明 --}}
        <div class="form-section">
            <h2 class="section-heading">商品名と説明</h2>

            <div class="form-group">
                <label class="form-label" for="name">商品名</label>
                <input type="text" id="name" name="name" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label" for="brand">ブランド名</label>
                <input type="text" id="brand" name="brand" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label" for="description">商品の説明</label>
                <textarea id="description" name="description" class="form-textarea"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="price">販売価格</label>
                <div class="price-input-wrapper">
                    <span class="price-prefix">¥</span>
                    <input type="number" id="price" name="price" class="form-input form-input--price">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">出品する</button>
    </form>
</div>
@endsection