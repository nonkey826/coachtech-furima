<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Item extends Model
{
    use HasFactory;

   protected $fillable = [
    'title',
    'description',
    'price',
    'image',
    'category',
    'status',
    'brand',
    'user_id',
    'is_sold',
];



    /**
     * 出品者（User）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedUsers()
{
    return $this->belongsToMany(User::class, 'favorites');
}

// ⭐ コメント
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
