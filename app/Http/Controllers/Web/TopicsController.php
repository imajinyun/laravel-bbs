<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends WebController
{
    public function index(Request $request, Topic $topic)
    {
        $topics = $topic->withOrder($request->order)->paginate(20);

        return view('web.topics.index', compact('topics'));
    }

    public function show(Request $request, Topic $topic)
    {
        return view('web.topics.show', compact('topic'));
    }
}
