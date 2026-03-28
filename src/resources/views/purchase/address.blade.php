@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="address-container">

    <h2 class="address-title">住所の変更</h2>

    <form action="{{ route('purchase.address.update', ['id' => $item->id]) }}" method="POST">
        @csrf

        {{-- 郵便番号 --}}
        <div class="address-form__group">
            <label class="address-form__label" for="postal_code">郵便番号</label>
            <input
                class="address-form__input"
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', $postal_code) }}"
                placeholder="123-4567"
            >
            @error('postal_code')
                <p class="address-form__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所 --}}
        <div class="address-form__group">
            <label class="address-form__label" for="address">住所</label>
            <input
                class="address-form__input"
                type="text"
                id="address"
                name="address"
                value="{{ old('address', $address) }}"
            >
            @error('address')
                <p class="address-form__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div class="address-form__group">
            <label class="address-form__label" for="building_name">建物名</label>
            <input
                class="address-form__input"
                type="text"
                id="building_name"
                name="building_name"
                value="{{ old('building_name', $building_name) }}"
            >
            @error('building_name')
                <p class="address-form__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="address-btn">更新する</button>

    </form>

</div>
@endsection