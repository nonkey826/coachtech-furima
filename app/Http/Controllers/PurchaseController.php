<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入確定処理
    public function store(Item $item)
    {
        $user = Auth::user();

        // 二重購入防止
        if ($item->is_sold) {
            abort(403);
        }

        // 配送先未登録チェック
        if (!$user->address) {
            return redirect()
                ->route('address.edit')
                ->with('error', '配送先住所を登録してください');
        }

        // purchases に保存
        Purchase::create([
            'user_id'    => $user->id,
            'item_id'    => $item->id,
            'address_id' => $user->address->id,
        ]);

        // 商品を売却済みに
        $item->update([
            'is_sold' => true,
        ]);

        return redirect()
            ->route('items.show', $item)
            ->with('success', '購入が完了しました');
    }

    // 支払い方法選択画面
    public function payment(Item $item)
    {
        return view('purchase.payment', compact('item'));
    }

    // 支払い方法確認画面
    public function confirm(Request $request, Item $item)
    {
        $paymentMethod = $request->payment_method;

        return view('purchase.confirm', compact(
            'item',
            'paymentMethod'
        ));
    }
}
