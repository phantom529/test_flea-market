@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')
<div class="detail">
    <div class="detail__left">

        {{-- 商品画像 --}}
        <div class="detail__image">
            @if($item->items_image && !str_starts_with($item->items_image, 'items/'))
                <img src="{{ $item->items_image }}" alt="{{ $item->name }}">
            @else
                <span class="detail__image-text">商品画像</span>
            @endif
        </div>

    </div>

    <div class="detail__right">

        {{-- 商品名・ブランド名 --}}
        <h2 class="detail__name">{{ $item->name }}</h2>
        <p class="detail__brand">{{ $item->brand_name }}</p>

        {{-- 価格 --}}
        <p class="detail__price">
            ¥{{ number_format($item->price) }}
            <span class="detail__price-tax">（税込）</span>
        </p>

        {{-- いいね・コメントアイコン --}}
<div class="detail__actions">
    <div class="detail__action-item">
        @auth
        <form id="like-form" action="{{ route('items.like', $item->id) }}" method="POST">
            @csrf
            <button type="button" id="like-btn" class="detail__icon-btn">
                <img src="{{ $liked ? asset('images/heart_active.png.png') : asset('images/heart_default.png') }}"
                     alt="いいね"
                     class="detail__icon"
                     id="like-img">
            </button>
        </form>
        @else
            <img src="{{ asset('images/heart_default.png') }}" alt="いいね" class="detail__icon">
        @endauth
        <span id="like-count">{{ $item->likes->count() }}</span>
    </div>
    <div class="detail__action-item">
        <img src="{{ asset('images/comment.png') }}" alt="コメント" class="detail__icon">
        <span>{{ $item->comments->count() }}</span>
    </div>
</div>

        {{-- 購入ボタン --}}
        @if($item->is_sold)
            <button class="detail__buy-btn detail__buy-btn--sold" disabled>SOLD</button>
        @else
            @auth
                <a href="{{ route('purchase.show', $item->id) }}" class="detail__buy-btn">
                    購入手続きへ
                </a>
            @else
                <a href="{{ route('register') }}" class="detail__buy-btn">
                    購入手続きへ
                </a>
            @endauth
        @endif

        {{-- 商品説明 --}}
        <div class="detail__section">
            <h3 class="detail__section-title">商品説明</h3>
            <p class="detail__description">{{ $item->description }}</p>
        </div>

        {{-- 商品情報 --}}
        <div class="detail__section">
            <h3 class="detail__section-title">商品の情報</h3>
            <div class="detail__info-row">
                <span class="detail__info-label">カテゴリー</span>
                <div class="detail__categories">
                    @foreach($item->categories as $category)
                        <span class="detail__category-tag">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="detail__info-row">
                <span class="detail__info-label">商品の状態</span>
                <span>{{ $item->condition }}</span>
            </div>
        </div>

        {{-- コメント一覧 --}}
        <div class="detail__section">
            <h3 class="detail__section-title">
                コメント（{{ $item->comments->count() }}）
            </h3>
            @foreach($item->comments as $comment)
                <div class="detail__comment">
                    <div class="detail__comment-user">
                        <div class="detail__comment-avatar"></div>
                        <span class="detail__comment-name">{{ $comment->user->name }}</span>
                    </div>
                    <p class="detail__comment-text">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>

        {{-- コメント入力 --}}
        <div class="detail__section">
            <h3 class="detail__section-title">商品へのコメント</h3>
            @auth
                <form method="POST" action="{{ route('comments.store', $item->id) }}">
                    @csrf
                    <textarea
                        name="content"
                        class="detail__comment-input"
                        rows="5"
                    ></textarea>
                    @error('content')
                        <p class="detail__error">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="detail__comment-btn">
                        コメントを送信する
                    </button>
                </form>
            @else
                <p class="detail__login-notice">
                    コメントするには<a href="{{ route('login') }}">ログイン</a>が必要です
                </p>
            @endauth
        </div>

    </div>
</div>
<script>
document.getElementById('like-btn')?.addEventListener('click', function () {
    const form = document.getElementById('like-form');
    const token = form.querySelector('input[name="_token"]').value;

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Content-Type': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('like-count').textContent = data.count;
        document.getElementById('like-img').src = data.liked
            ? '{{ asset("images/heart_active.png") }}'
            : '{{ asset("images/heart_default.png") }}';
    });
});
</script>
@endsection
