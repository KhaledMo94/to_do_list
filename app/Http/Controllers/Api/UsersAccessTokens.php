<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UsersAccessTokens extends Controller
{
    public function store(Request $request){

        $request->validate([
            'email'                      =>['required','max:255','min:3','string'],
            'password'                   =>['required','min:6','string','max:255'],
            'device_name'                =>'string|max:255',
        ]);

        $user = User::where('email',$request->input('email'))->first();
        if($user && Hash::check($request->password , $user->password)){
            $device_name = $request->device_name ?? $request->userAgent();
            $token = $user->createToken($device_name);
            return response()->json([
                'token'                     =>$token->plainTextToken,
                'user'                      =>$user,
            ],201);
        }

        return response()->json([
            'message'               =>'invalid credentials'
        ],401);
    }

    public function destroy(){
        request()->user('sanctum')->currentAccessToken()->delete();
        return response()->json([
            'message'               =>'logged_out',
        ],203);
    }

    public function destroyAll(){
        request()->user('sanctum')->tokens()->delete();
        return response()->json([
            'message'               =>'logged_out from all',
        ],203);
    }
}
