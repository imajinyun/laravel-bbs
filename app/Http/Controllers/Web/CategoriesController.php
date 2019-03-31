<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends WebController
{
    public function show(Request $request, Category $category, Topic $topic, User $user)
    {
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);
        $users = $user->getActiveUsers();

        return view('web.topics.index', compact(
            'topics',
            'category',
            'users'
        ));
    }
}
