<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class InspectionsController extends AdminController
{
    public function index()
    {
        $data = [
            'environment' => self::getEnvironmentData(),
            'communication' => self::getCommunicationData(),
            'permission' => [],
            'utilization' => self::getUtilizationData(),
        ];

        return view('admin.systems.inspections.index', compact(
            'data'
        ));
    }

    public function php()
    {
        phpinfo();

        return response()->json();
    }

    private static function getEnvironmentData(): array
    {
        return [
            ['name' => '操作系统', 'recommend' => 'Linux', 'current' => PHP_OS, 'lowest' => ''],
            ['name' => 'PHP 版本', 'recommend' => '7.1.0+', 'current' => PHP_VERSION, 'lowest' => '7.1.0', 'href' => 'admin.systems.inspections.php'],
            ['name' => 'PHP 运行用户', 'recommend' => 'www', 'current' => getenv('USER'), 'lowest' => ''],
            ['name' => 'PDO MySQL', 'recommend' => '必须', 'current' => extension_loaded('pdo_mysql') ? '已安装' : '未安装', 'lowest' => ''],
            ['name' => '文件上传大小', 'recommend' => '大于 100M', 'current' => ini_get('upload_max_filesize'), 'lowest' => '2M'],
            ['name' => '表单数据大小', 'recommend' => '大于 100M', 'current' => ini_get('post_max_size'), 'lowest' => '8M'],
            ['name' => 'PHP 脚本最大执行时间', 'recommend' => '300s', 'current' => ini_get('max_execution_time'), 'lowest' => '60s'],
        ];
    }

    private static function getCommunicationData(): array
    {
        return [
            ['name' => '邮件发送', 'current' => ''],
        ];
    }

    private static function getUtilizationData(): array
    {
        $path = storage_path();
        $data = [
            [
                'name' => 'app',
                'free' => '1.8GB',
                'total' => '15GB',
                'rate' => '80%',
            ],
            [
                'name' => 'framework',
                'free' => '1.5GB',
                'total' => '12GB',
                'rate' => '86%',
            ],
            [
                'name' => 'logs',
                'free' => '5.8GB',
                'total' => '11GB',
                'rate' => '80%',
            ],
        ];

        return array_map(static function ($value) use ($path) {
            $directory = $path . '/' . $value['name'];
            $total = disk_total_space($directory);
            $free = disk_free_space($directory);
            $rate = (string) number_format($free / $total, 2) * 100 . '%';
            $value['free'] = format_bytes($free);
            $value['total'] = format_bytes($total);
            $value['rate'] = $rate;

            return $value;
        }, $data);
    }
}
