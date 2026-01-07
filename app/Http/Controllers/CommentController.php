<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Item $item)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    Comment::create([
        'user_id' => Auth::id(),
        'item_id' => $item->id,
        'comment' => $request->comment,
    ]);

    return redirect()->route('items.show', $item);
}

}
