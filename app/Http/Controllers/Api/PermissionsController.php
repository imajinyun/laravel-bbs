<?php

namespace App\Http\Controllers\Api;

use App\Transformers\PermissionTransformer;

class PermissionsController extends ApiController
{
    public function index(): Response
    {
        $permissions = $this->user()->getAllPermissions();

        return $this->response->collection($permissions, new PermissionTransformer());
    }
}
