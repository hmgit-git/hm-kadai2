@extends('layouts.app') {{-- 必要なら --}}
@section('content')

<h2>商品登録</h2>

<form method="POST" action="{{ url('/products/register') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label>商品名：</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>値段：</label>
        <input type="text" name="price" value="{{ old('price') }}">
    </div>

    <div>
        <label>商品画像：</label>
        <input type="file" name="image">
    </div>

    <div>
        <label>季節：</label><br>
        <label><input type="checkbox" name="seasons[]" value="春"> 春</label>
        <label><input type="checkbox" name="seasons[]" value="夏"> 夏</label>
        <label><input type="checkbox" name="seasons[]" value="秋"> 秋</label>
        <label><input type="checkbox" name="seasons[]" value="冬"> 冬</label>
    </div>

    <div>
        <label>品説明：</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <button type="button" onclick="history.back()">戻る</button>
        <button type="submit">登録</button>
    </div>

</form>

@endsection