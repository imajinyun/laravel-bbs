<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LinkResource;
use App\Models\Link;

class LinksController extends ApiController
{
    public function index(Link $link)
    {
        $links = $link->getCacheLinks();

        return LinkResource::collection($links);
    }
}
