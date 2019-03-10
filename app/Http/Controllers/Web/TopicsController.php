<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Web\TopicImageRequest;
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

        return view('web.topics.index', compact(
            'topics'
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

        return redirect()
            ->to($topic->link())
            ->with('success', '创建成功。');
    }

    public function edit(Topic $topic)
    {
        $categories = Category::all();

        return view('web.topics.topic', compact(
            'topic',
            'categories'
        ));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->all());

        return redirect()
            ->to($topic->link())
            ->with(['success' => '话题题更新成功！']);
    }

    public function show(Topic $topic)
    {
        return view('web.topics.show', compact('topic'));
    }

    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        $data = ['success' => false, 'msg' => '上传失败！', 'path' => ''];

        /** @var \Illuminate\Http\UploadedFile $file */
        if ($file = $request->uploader) {
            $size = $file->getSize();
            if ($size > 88865) {
                $data['msg'] = '图片尺寸太大，请上传宽度在 800*600 以下的图片。';

                return $data;
            }
            $result = $uploader->upload(
                $file,
                'topics',
                Auth::id(),
                512
            );

            if ($result) {
                $data['success'] = true;
                $data['msg'] = '上传成功！';
                $data['path'] = $result['path'];
            }
        }

        return $data;
    }
}
