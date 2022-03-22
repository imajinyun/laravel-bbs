<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ReplyRequest;
use App\Models\Reply;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $content = $request->get('content');
        $reply->content = $content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();
        $content = Str::limit($content, 10);

        return redirect()
            ->to($reply->topic->link())
            ->with('success', "话题评论【{$content}】创建成功！");
    }

    public function destroy(Request $request, Reply $reply)
    {
        try {
            $this->authorize('destroy', $reply);
        } catch (AuthorizationException $e) {
        }
        $name = Str::limit($reply->content, 10);

        try {
            $reply->delete();
        } catch (\Exception $e) {
            return redirect()
                ->to($reply->topic->link())
                ->with('danger', "评论【{$name}】删除失败！");
        }

        return redirect()
            ->to($reply->topic->link())
            ->with('success', "评论【{$name}】删除成功！");
    }
}
