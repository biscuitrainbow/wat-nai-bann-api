<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function detail()
    {
        return auth()->user();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|alpha',
            'gender' => 'required|min:3|alpha',
            'tel' => 'required|min:3|max:10',
            'date_of_birth' => 'required|before:today',
        ]);

    }
}
