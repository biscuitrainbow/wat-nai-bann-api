<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;
use App\News;

class NewsController extends ApiController
{
    public function index()
    {
        $news = News::orderBy('created_at','desc')->get();
        return $this->respond($news);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|',
            'content' => 'required|min:3|',
            'due_date' => 'date',
            'cover' => 'url',
            'category' => ['required', Rule::in(['general', 'activity'])],
        ]);


        $news = new News([
            'title' => $request->title,
            'content' => $request->content,
            'due_date' => $request->due_date,
            'category' => $request->category,
            'cover' => $request->cover,
        ]);

        $user = auth()->user();
        $user->news()->save($news);

        return $this->respondCreated($news);
    }
}
