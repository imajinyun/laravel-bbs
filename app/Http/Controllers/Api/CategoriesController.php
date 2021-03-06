<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoriesController extends ApiController
{
    public function index(): Response
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }
}
