<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;

/*
|--------------------------------------------------------------------------
| 認証（会員登録・ログイン）
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| トップページ（商品一覧）
|--------------------------------------------------------------------------
*/
Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

/*
|--------------------------------------------------------------------------
| 商品一覧・出品
|--------------------------------------------------------------------------
*/

// 商品一覧
Route::get('/items', [ItemController::class, 'index'])
    ->name('items.index');

// 🔴 出品フォーム（⚠ {item} より必ず上）
Route::get('/items/create', [ItemController::class, 'create'])
    ->middleware('auth')
    ->name('items.create');

// 出品処理
Route::post('/items', [ItemController::class, 'store'])
    ->middleware('auth')
    ->name('items.store');

/*
|--------------------------------------------------------------------------
| 商品詳細・削除
|--------------------------------------------------------------------------
*/

// 商品詳細
Route::get('/items/{item}', [ItemController::class, 'show'])
    ->name('items.show');

// 商品削除（出品者のみ）
Route::delete('/items/{item}', [ItemController::class, 'destroy'])
    ->middleware('auth')
    ->name('items.destroy');

/*
|--------------------------------------------------------------------------
| 商品購入
|--------------------------------------------------------------------------
*/
Route::post('/items/{item}/purchase', [PurchaseController::class, 'store'])
    ->middleware('auth')
    ->name('item.purchase');

/*
|--------------------------------------------------------------------------
| コメント
|--------------------------------------------------------------------------
*/
Route::post('/items/{item}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

/*
|--------------------------------------------------------------------------
| お気に入り
|--------------------------------------------------------------------------
*/
Route::post('/favorites/{item}', [FavoriteController::class, 'store'])
    ->middleware('auth')
    ->name('favorite.store');

Route::delete('/favorites/{item}', [FavoriteController::class, 'destroy'])
    ->middleware('auth')
    ->name('favorite.destroy');

/*
|--------------------------------------------------------------------------
| マイページ
|--------------------------------------------------------------------------
*/
Route::get('/mypage', [MyPageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage.index');

/*
|--------------------------------------------------------------------------
| プロフィール
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile/create', [ProfileController::class, 'create'])
        ->name('profile.create');

    Route::post('/profile', [ProfileController::class, 'store'])
        ->name('profile.store');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| 配送先住所
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/address', [AddressController::class, 'edit'])
        ->name('address.edit');

    Route::post('/address', [AddressController::class, 'update'])
        ->name('address.update');
});

/*
|--------------------------------------------------------------------------
| ログイン後リダイレクト
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return redirect()->route('items.index');
});
