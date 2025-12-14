<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Favorite;
use App\Models\Profile;
use App\Models\Address;

class User extends Authenticatable
{
    use Notifiable;

    // 出品した商品
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // 購入履歴
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // お気に入り
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // プロフィール
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //アドレス入力
    public function address()
{
    return $this->hasOne(Address::class);
}
}
