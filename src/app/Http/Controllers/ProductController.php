<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        return "詳細ページはまだ作成中です！（ID: {$productId}）";
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048', // 2MBまで
            'seasons' => 'required|array',
            'description' => 'required|string',
        ]);

        // 画像アップロード処理
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // データ保存
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'seasons' => $validated['seasons'],
            'description' => $validated['description'],
        ]);

        return redirect('/products')->with('message', '商品を登録しました！');
    }
}
