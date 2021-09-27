<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::create($validateData);
        $user->update(['password' => Hash::make($request->password)]);
        $accessToken = $user->createToken('authToken')->accessToken;
        try {
            return response(['status' => 'ok', 'code' => 200, 'data' => $user, 'access-token' => $accessToken, 'message' => 'User created succesfull'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($validateData)){
            return response(['message' => 'Invalide credentials'],404);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        try {
            return response(['status' => 'ok', 'code' => 200, 'data' => auth()->user(), 'access-token' => $accessToken, 'message' => 'Login Successfull'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()],400);
        }

    }
}
