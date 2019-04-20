<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TopicRequest;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\TopicTransformer;
use Dingo\Api\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class TopicsController extends ApiController
{
    public function index(Request $request, Topic $topic): Response
    {
        $query = $topic->query();

        if ($categoryId = $request->category_id) {
            $query->where('category_id', $categoryId);
        }

        if ($request->order === 'recent') {
            $query->withOrder($request->order);
        } else {
            $query->withOrder();
        }
        $topics = $query->paginate(20);

        return $this->response->paginator($topics, new TopicTransformer());
    }

    public function userIndex(Request $request, User $user): Response
    {
        $topics = $user->topics()->withOrder($request->order)->paginate(20);

        return $this->response->paginator($topics, new TopicTransformer());
    }

    public function store(TopicRequest $request, Topic $topic): Response
    {
        $topic->fill($request->all());
        $topic->user_id = $this->user()->id;
        $topic->save();

        return $this->response
            ->item($topic, new TopicTransformer())
            ->setStatusCode(201);
    }

    public function update(TopicRequest $request, Topic $topic): Response
    {
        try {
            $this->authorize('update', $topic);
        } catch (AuthorizationException $e) {
        }
        $topic->update($request->all());

        return $this->response->item($topic, new TopicTransformer());
    }

    public function show(Topic $topic)
    {
        return $this->response->item($topic, new TopicTransformer());
    }

    public function destroy(Topic $topic): Response
    {
        try {
            $this->authorize('destroy', $topic);
        } catch (AuthorizationException $e) {
        }
        $topic->delete();

        return $this->response->noContent();
    }
}
