<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;
        $page = $request->query('page', 'buy');

        if ($page === 'sell') {
            // 出品した商品
            $items = $user->items;

        } elseif ($page === 'favorite') {
            // お気に入り商品
            $items = $user->favorites()
                ->with('item')
                ->get()
                ->pluck('item');

        } else {
            // 購入した商品（Purchase）
            $items = $user->purchases()
                ->with(['item', 'address'])
                ->get();
        }

        return view('mypage.index', compact(
            'user',
            'profile',
            'items',
            'page'
        ));
    }
}
