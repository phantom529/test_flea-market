@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('content')
<div class="page">
  <div class="content">

    {{-- タブ --}}
    <div class="tabs">
      <a href="{{ route('items.index', ['keyword' => $keyword]) }}"
         class="tabs__link {{ ($activeTab ?? '') === 'recommend' ? 'is-active' : '' }}">
        おすすめ
      </a>
      <a href="{{ route('items.mylist', ['keyword' => $keyword]) }}"
         class="tabs__link {{ ($activeTab ?? '') === 'mylist' ? 'is-active' : '' }}">
        マイリスト
      </a>
    </div>

    {{-- 商品グリッド --}}
    <div class="grid">
      @if($items->isEmpty())
        <p class="empty">表示する商品がありません。</p>
      @else
        @foreach($items as $item)
          <a class="card" href="{{ route('items.show', $item->id) }}">
    <div class="card__image">
        <img src="{{ $item->items_image }}" alt="{{ $item->name }}" class="card__img">
        @if($item->is_sold)
          <span class="card__sold">SOLD</span>
        @endif
    </div>
            <div class="card__name">{{ $item->name }}</div>
          </a>
        @endforeach
      @endif
    </div>

  </div>{{-- /.content --}}
</div>{{-- /.page --}}
@endsection
