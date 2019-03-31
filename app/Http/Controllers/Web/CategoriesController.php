<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends WebController
{
    public function show(Request $request, Category $category, Topic $topic, User $user, Link $link)
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);
        $users = $user->getActiveUsers();
        $links = $link->getCacheLinks();

        return view('web.topics.index', compact(
            'topics',
            'category',
            'users',
            'links'
        ));
    }
}
