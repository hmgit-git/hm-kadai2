@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div style="margin-bottom: 16px;">
    <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
</div>

<h2>商品編集</h2>

<form method="POST" action="{{ url('/products/' . $product->id . '/update') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label>商品名</label><br>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>値段</label><br>
        <input type="text" name="price" value="{{ old('price', $product->price) }}">
        @error('price')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>季節（複数選択可）</label><br>
        @foreach ($allSeasons as $season)
        <label>
            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $season->name }}
        </label>
        @endforeach
        @error('seasons')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品説明</label><br>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>商品画像</label><br>
        <input type="file" name="image">
        @if ($product->image_path)
        <div>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="" style="width: 200px;">
        </div>
        @endif
        @error('image')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-top: 16px;">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-success">変更を保存</button>
    </div>

    <div style="margin-top: 32px; text-align: right;">
        <form method="POST" action="{{ url('/products/' . $product->id . '/delete') }}">
            @csrf
            <button type="submit" style="background: none; border: none;">
                <img src="{{ asset('img/trash-icon.png') }}" alt="削除" style="width: 32px;">
            </button>
        </form>
    </div>
</form>
@endsection