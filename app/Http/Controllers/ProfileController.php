<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    // 編集画面表示
    public function edit()
    {
        $profile = Auth::user()->profile;

        return view('profile.edit', compact('profile'));
    }

    // 更新処理
    public function update(Request $request)
    {
        $request->validate([
            'nickname' => 'required|max:255',
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nickname' => $request->nickname,
                'avatar' => null,
            ]
        );

        return redirect()->route('mypage.index');
    }

    public function create()
{
    return view('profile.create');
}

public function store(Request $request)
{
    // いまは保存しない
    return redirect()->route('mypage');
}


}
