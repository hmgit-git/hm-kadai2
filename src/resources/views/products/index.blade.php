@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<!-- タイトル & 商品追加ボタン -->
<div class="product-page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <h2>商品一覧</h2>
    <a href="{{ route('product.create') }}" class="btn btn-primary">＋ 商品を追加</a>
</div>

<!-- 本体：検索 + 商品カード -->
<div class="product-page" style="display: flex; gap: 24px;">

    <!-- 検索エリア -->
    <div class="search-area" style="width: 300px;">
        <form method="GET" action="{{ route('products.index') }}">
            <input type="text" name="keyword" class="form-control mb-2" placeholder="商品名を入力" value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-warning mb-2">検索</button>

            <select name="sort" class="form-select mb-2" onchange="this.form.submit()">
                <option value="">価格順で表示</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順</option>
            </select>

            @if(request('sort'))
            <div class="sort-tag">
                並び順:
                <span class="sort-pill">
                    {{ request('sort') == 'high' ? '高い順' : '低い順' }}
                    <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" class="sort-remove">×</a>
                </span>
            </div>
            @endif

        </form>
    </div>

    <!-- 商品リスト -->
    <div class="product-list" style="flex: 1; display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
        @foreach ($products as $product)
        <a href="{{ url('/products/' . $product->id) }}" class="card-link" style="text-decoration: none; color: inherit;">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body" style="display: flex; justify-content: space-between; align-items: center; padding: 12px;">
                    <h5 class="card-title" style="margin: 0;">{{ $product->name }}</h5>
                    <p class="card-price" style="margin: 0;">{{ $product->price }}円</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- ページネーション -->
<div class="pagination-container" style="display: flex; justify-content: center; margin-top: 24px;">
    {{ $products->links() }}
</div>
@endsection