<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Transformer\UserTransformer;
use Illuminate\Validation\Rule;

class UserController extends ApiController
{
    public function __construct(UserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function detail()
    {
        $user = auth()->user();
        $user->token = $user->accessToken;

        return $this->respondWithTransformer($user);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|',
            'gender' => ['required', Rule::in(['หญิง', 'ชาย', 'ไม่ระบุ'])],
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'tel' => $request->tel,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return $this->respondSuccess();
    }
}
