<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends WebController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic)
    {
        $topics = $topic->withOrder($request->order)->paginate(20);

        return view('web.topics.index', compact('topics'));
    }

    public function create(Request $request, Topic $topic)
    {
        $categories = Category::all();

        return view('web.topics.topic', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()
            ->to($topic->link())
            ->with('success', '创建成功。');
    }

    public function show(Request $request, Topic $topic)
    {
        return view('web.topics.show', compact('topic'));
    }
}
