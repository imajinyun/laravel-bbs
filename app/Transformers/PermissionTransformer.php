<?php

namespace App\Transformers;

use App\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission): array
    {
        return [
            'id' => $permission->id,
            'name' => $permission->name,
            'slug' => $permission->slug,
        ];
    }
}
