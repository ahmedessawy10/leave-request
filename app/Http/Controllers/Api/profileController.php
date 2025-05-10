<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            "name" => "string |nullable",
            "email" => "string|nullable",
            "password" => "min:8|nullable",
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        Auth::user()->update();

        return response()->json([
            "message" => "profile updated successfully",

        ], 201);
    }

    public function getProfile()
    {
        return response()->json([
            "message" => "return profile successfully",
            "profile" => Auth::user()->select("id", "name", "email")->first(),
        ], 201);
    }
}
