<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function edit()
    {
        $address = Auth::user()->address;

        return view('address.edit', compact('address'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'postal_code' => 'required|max:20',
            'address'     => 'required|max:255',
            'building'    => 'nullable|max:255',
        ]);

        Address::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'postal_code' => $request->postal_code,
                'address'     => $request->address,
                'building'    => $request->building,
            ]
        );

        return redirect()->route('mypage.index');
    }
}
