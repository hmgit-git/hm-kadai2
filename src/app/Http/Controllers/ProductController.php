<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('seasons');

        // キーワード検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $allSeasons = Season::all();

        return view('products.show', compact('product', 'allSeasons'));
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // 値更新
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // 画像アップロード（あれば）
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fruits-img', 'public');
            $product->image_path = $path;
        }

        $product->save();

        // 中間テーブル更新（季節）
        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index')->with('message', '商品を更新しました');
    }

    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $allSeasons = Season::all();

        return view('products.edit', compact('product', 'allSeasons'));
    }
    
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('message', '商品を削除しました');
    }


    public function create()
    {
        $allSeasons = Season::all();
        return view('products.create', compact('allSeasons'));
    }

    public function store(StoreProductRequest $request)
    {
        // 画像アップロード
        $imagePath = $request->file('image')->store('products', 'public');

        // 商品登録
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $imagePath,
            'description' => $request->description,
        ]);

        // 中間テーブル保存
        $product->seasons()->attach($request->seasons);

        return redirect()->route('products.index')->with('message', '商品を登録しました！');
    }
}
