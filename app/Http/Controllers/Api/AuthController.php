<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Transformer\UserTransformer;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $user->token = $user->createToken('WatNaiBann')->accessToken;
            $user->age = $user->age;

            return $this->respond($user);
        } else {
            return $this->respondUnauthorized();
        }
    }

    public function loginWithFacebook(Request $request)
    {
        $user = Socialite::driver('facebook')->userFromToken($request->fb_token);

        dump($user);
    }

    public function logout(Request $request)
    {
        auth()->user()->token()->revoke();

        return $this->respondSuccess();
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'gender' => ['required', Rule::in(['หญิง', 'ชาย', 'ไม่ระบุ'])],
            // 'date_of_birth' => 'date|before:today',
        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'gender' => request()->gender,
            // 'tel' => request()->tel,
            // 'date_of_birth' => request()->date_of_birth,
        ]);

        $token = $user->createToken('WatNaiBann')->accessToken;
        $user->token = $token;

        return $this->respondCreated($user);
    }
}
