<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Dingo\Api\Http\Response;

class CategoriesController extends ApiController
{
    public function index(): Response
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }
}
