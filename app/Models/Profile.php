<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'nickname',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
