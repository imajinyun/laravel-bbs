<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Web\TopicRequest;
use App\Models\Category;
use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class TopicsController extends WebController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic, User $user, Link $link)
    {
        $topics = $topic->withOrder($request->offsetGet('order'))->paginate(20);
        $users = $user->getActiveUsers();
        $links = $link->getCacheLinks();

        return view('web.topics.index', compact(
            'topics',
            'users',
            'links'
        ));
    }

    public function create(Request $request, Topic $topic)
    {
        $categories = Category::all();

        return view('web.topics.topic', compact(
            'topic',
            'categories'
        ));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        $title = $topic->title;

        return redirect()
            ->to($topic->link())
            ->with('success', "话题【{$title}】创建成功！");
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();

        return view('web.topics.topic', compact(
            'topic',
            'categories'
        ));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        try {
            $this->authorize('update', $topic);
        } catch (AuthorizationException $e) {
            return redirect()
                ->to($topic->link())
                ->with(['danger' => $e->getMessage()]);
        }
        $title = $topic->title;
        $topic->update($request->all());

        return redirect()
            ->to($topic->link())
            ->with(['success' => "话题【{$title}】更新成功！"]);
    }

    public function show(Request $request, Topic $topic)
    {
        if (! empty($topic->slug) && $topic->slug !== $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('web.topics.show', compact('topic'));
    }

    public function destroy(Topic $topic)
    {
        $title = $topic->title;

        try {
            $this->authorize('destroy', $topic);
        } catch (AuthorizationException $e) {
            return redirect()
                ->route('topics.index')
                ->with('warning', "你没有权限删除话题【{$title}】");
        }

        try {
            $topic->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('topics.show')
                ->with('danger', "话题【{$title}】删除失败！");
        }

        return redirect()
            ->route('topics.index')
            ->with('success', "话题【{$title}】删除成功！");
    }

    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        $data = ['status' => false, 'msg' => '上传失败！', 'path' => ''];

        /** @var \Illuminate\Http\UploadedFile $file */
        if ($file = $request->uploader) {
            $size = $file->getSize();
            if ($size > 1048576) {
                $data['msg'] = '上传图片太大，请上传 2MB 以下的图片。';

                return $data;
            }
            $result = $uploader->upload(
                $file,
                'topics',
                Auth::id(),
                512
            );

            if ($result && $result['status']) {
                $data = array_merge($data, $result);
            }
        }

        return $data;
    }
}
