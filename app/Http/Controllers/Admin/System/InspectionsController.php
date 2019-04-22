<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class InspectionsController extends AdminController
{
    public function index()
    {
        $data = [
            'environment' => [],
            'communication' => [],
            'permission' => [],
            'utilization' => [
                [
                    'name' => '/storage/app',
                    'available' => '1.8GB',
                    'total' => '15GB',
                    'surplus' => '80%',
                ],
                [
                    'name' => '/storage/framework',
                    'available' => '1.5GB',
                    'total' => '12GB',
                    'surplus' => '86%',
                ],
                [
                    'name' => '/storage/logs',
                    'available' => '5.8GB',
                    'total' => '11GB',
                    'surplus' => '80%',
                ],
            ],
        ];

        return view('admin.systems.inspection.index', compact(
            'data'
        ));
    }
}
