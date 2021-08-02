<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{
    public function index(Request $request)
    {
        CategoryResource::wrap('data');
        return CategoryResource::collection(Category::all());
    }
}
