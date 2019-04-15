<?php

namespace App\Transformers;

use App\Models\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{
    public function transform(Link $link): array
    {
        return [
            'id' => $link->id,
            'name' => $link->name,
            'href' => $link->href,
        ];
    }
}
