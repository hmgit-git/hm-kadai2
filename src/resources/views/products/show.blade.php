@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="product-detail-container">
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
    </div>
    <form method="POST" action="{{ url('/products/' . $product->id . '/update') }}" enctype="multipart/form-data">
        @csrf
        <div class="product-detail-form">
            <!-- 画像 -->
            <div>
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-image-preview">
                <input type="file" name="image" class="form-control mt-2">
                @error('image') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <!-- フォーム入力 -->
            <div style="flex: 1;">
                <div>
                    <label>商品名</label><br>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
                    @error('name') <div style="color: red;">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label>価格</label><br>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control">
                    @error('price') <div style="color: red;">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label>季節</label><br>
                    @foreach ($allSeasons as $season)
                    <label>
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                            {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                    @endforeach
                    @error('seasons') <div style="color: red;">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- 説明 -->
        <div class="product-description">
            <label>商品説明</label><br>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <!-- ボタン群 -->
        <div class="product-detail-actions">
            <div class="action-left">
                <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
                <button type="submit" class="btn btn-orange">変更を保存</button>
            </div>
        </div>
    </form>
    
    <div class="action-right">
        <form method="POST" action="{{ url('/products/' . $product->id . '/delete') }}">
            @csrf
            <button type="submit" class="trash-icon" onclick="return confirm('本当に削除してもよろしいですか？')">
                <i class="fa-solid fa-trash"></i>
            </button>

        </form>
    </div>

</div>
@endsection