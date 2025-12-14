<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * 商品一覧
     */
    public function index()
    {
        $items = Item::latest()->get();
        return view('items.index', compact('items'));
    }

    /**
     * 商品詳細
     */
    public function show(Item $item)
    {
        $item->load('comments');

        $address = Auth::check()
            ? Auth::user()->address
            : null;

        return view('items.show', compact('item', 'address'));
    }

    /**
     * 出品フォーム
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * 商品登録
     */
    public function store(Request $request)
{
    // ✅ ① バリデーション（必須チェック）
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|integer',
        'image' => 'required|string',
    ]);

    // ✅ ② 保存
    Item::create([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $request->image,
        'category' => $request->category,
        'status' => $request->status,
        'brand' => $request->brand,
        'user_id' => Auth::id(),
        'is_sold' => false,
    ]);

    return redirect()->route('items.index');
}

/**
 * 商品削除
 */
public function destroy(Item $item)
{
    // 自分の出品じゃなければ削除させない
    if ($item->user_id !== Auth::id()) {
        abort(403);
    }

    $item->delete();

    return redirect()->route('items.index')
        ->with('success', '商品を削除しました');
}


}

