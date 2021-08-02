<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PermissionResource;

class PermissionsController extends ApiController
{
    public function index()
    {
        $permissions = $this->user()->getAllPermissions();

        return PermissionResource::collection($permissions);
    }
}
