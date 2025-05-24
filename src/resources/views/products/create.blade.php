@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="product-detail-container">
    <h2>商品登録</h2>

    <form method="POST" action="{{ url('/products/register') }}" enctype="multipart/form-data">
        @csrf

        <div class="product-detail-form" style="flex: 1;">
            <!-- 商品名 -->
            <div>
                <label>商品名 <span class="required-label">必須</span></label><br>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力" class="form-control">
                @error('name') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <!-- 価格 -->
            <div>
                <label>価格 <span class="required-label">必須</span></label><br>
                <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力" class="form-control">
                @error('price') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <!-- 商品画像 -->
            <div>
                <label>商品画像 <span class="required-label">必須</span></label><br>
                <input type="file" name="image" class="form-control">
                @error('image') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <!-- 季節 -->
            <div>
                <label>季節 <span class="required-label">必須</span><span class="labeltext-red">複数選択可</span></label><br>
                @foreach ($allSeasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ is_array(old('seasons')) && in_array($season->id, old('seasons')) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
                @endforeach
                @error('seasons') <div style="color: red;">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="product-description">
            <label>商品説明 <span class="required-label">必須</span></label><br>
            <textarea name="description" placeholder="商品の説明を入力" class="form-control">{{ old('description') }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <!-- ボタン -->
        <div class="product-detail-actions">
            <div class="action-left">
                <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
                <button type="submit" class="btn btn-orange">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection