@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<h2 style="margin-bottom: 24px;">商品一覧</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
    @foreach ($products as $product)
    <div style="border: 1px solid #ccc; border-radius: 8px; overflow: hidden; background: #fff;">
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
            style="width: 100%; height: 200px; object-fit: cover;">
        <div style="padding: 16px;">
            <h3 style="margin-bottom: 8px;">{{ $product->name }}</h3>
            <p style="margin: 4px 0;"><strong>価格：</strong>{{ $product->price }}円</p>
            <p style="margin: 4px 0;"><strong>旬の季節：</strong>{{ $product->seasons->pluck('name')->join('、') }}</p>
            <p style="margin-top: 8px; font-size: 14px; color: #555;">{{ $product->description }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-container">
    {{ $products->links() }}
</div>
@endsection