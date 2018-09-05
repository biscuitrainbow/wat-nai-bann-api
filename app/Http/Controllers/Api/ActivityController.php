<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;

class ActivityController extends ApiController
{
    public function index()
    {
        $user = auth()->user();

        $activities = $user->activities()->orderBy('datetime', 'desc')->get();
        return $this->respond($activities);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'title' => 'required',
            'point' => 'required',
        ]);

        $activity = new Activity([
            'title' => $request->title,
            'datetime' => $request->datetime,
            'point' => $request->point,
            'tags' => $request->tags,
        ]);

        $user->activities()->save($activity);
        return $this->respondCreated($activity);
    }

    public function update(Request $request, Activity $activity)
    {
        $user = auth()->user();

        $this->validate($request, [
            'title' => 'required',
            'point' => 'required',
        ]);

        $activity->update([
            'title' => $request->title,
            'datetime' => $request->datetime,
            'point' => $request->point,
            'tags' => $request->tags,
        ]);

        return $this->respondSuccess();
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return $this->respondSuccess();
    }
}
