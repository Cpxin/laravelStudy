<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\User;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


//use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    //
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->generateToken();
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response(['status' => 'success'])
            ->header('Authorization', $token);
    }
    public function user(Request $request)
    {
        $user = User::find(JWTAuth::user());
        return response([
            'status' => 'success',
            'data' => $user
        ]);
//        return dd(Auth::user()->id);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
           'status'=>'success',
           'msg'=>'logged out Successfully.'
        ]);
    }
}
