<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\ReplyTransformer;

class RepliesController extends ApiController
{
    public function index(Topic $topic): Response
    {
        $replies = $topic->replies()->paginate(20);

        return ReplyResource::collection($replies);
    }

    public function userIndex(User $user): Response
    {
        $replies = $user->replies()->paginate(20);

        return ReplyResource::collection($replies);
    }

    public function store(ReplyRequest $request, Topic $topic, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->user_id = $this->user()->id;
        $reply->topic_id = $topic->id;
        $reply->save();

        return $this->response
            ->item($reply, new ReplyTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Topic $topic, Reply $reply): Response
    {
        if ((int) $reply->topic_id !== (int) $topic->id) {
            $this->response->errorBadRequest();
        }

        $this->authorize('destroy', $reply);
        $reply->delete();

        return $this->response->noContent();
    }
}
