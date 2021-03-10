<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Transformers\LinkTransformer;

class LinksController extends ApiController
{
    public function index(Link $link): Response
    {
        $links = $link->getCacheLinks();

        return $this->response->collection($links, new LinkTransformer());
    }
}
