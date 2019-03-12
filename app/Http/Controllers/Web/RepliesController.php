<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ReplyRequest;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function store(ReplyRequest $request, Reply $reply)
    {
        $content = $request->get('content');
        $reply->content = $content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();
        $content = str_limit($content, 10);

        return redirect()
            ->to($reply->topic->link())
            ->with('success', "话题回复【{$content}】创建成功！");
    }

    public function destroy(ReplyRequest $request, Reply $reply)
    {
    }
}
