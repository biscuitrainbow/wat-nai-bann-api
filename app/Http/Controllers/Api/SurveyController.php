<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Survey;
use Illuminate\Validation\Rule;
use App\User;

class SurveyController extends ApiController
{
    public function index()
    {
        return Survey::all();
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'point' => 'required|numeric|min:0|max:28',
            'result' => ['required', Rule::in(['ปกติ', 'ผิดปกติ'])],

        ]);

        $survey = new Survey([
            'point' => $request->point,
            'result' => $request->result
        ]);

        $user->surveys()->save($survey);

        return $this->respondCreated($survey);
    }

    public function userSurvey(User $user)
    {
        $surveys = $user->surveys;

        return $this->respond($surveys);
    }
}
