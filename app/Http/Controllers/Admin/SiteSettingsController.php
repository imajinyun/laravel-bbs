<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SiteSettingsController extends AdminController
{
    public function info()
    {
        $site = [];
        if ($setting = Setting::where('name', '=', 'site')->first()) {
            $site = $setting->toArray()['value'];
        }
        $site = array_merge(self::getDefaultAttributes(), $site ?? []);

        return view('admin.settings.site.info', compact(
            'site'
        ));
    }

    public function infoUpdate(Request $request)
    {
        $data = $request->all();

        $site = [];
        if ($setting = Setting::whereName('site')->first()) {
            $site = $setting->toArray()['value'];
        }
        $search = array_flip(array_keys(self::getDefaultAttributes()));
        foreach ($data as $key => $val) {
            if (! array_key_exists($key, $search)) {
                unset($data[$key]);
            }
        }
        $data = array_merge($site ?? [], $data);
        $setting->value = $data;
        $setting->save();

        return self::successResponse('站点基本信息设置成功');
    }

    private static function getDefaultAttributes(): array
    {
        return [
            'name' => '',
            'slogan' => '',
            'url' => '',
            'logo' => '',
            'seo_keywords' => '',
            'seo_description' => '',
            'master_email' => '',
            'icp' => '',
            'analytics' => '',
            'status' => 'open',
            'closed_note' => '',
            'favicon' => '',
            'copyright' => '',
        ];
    }
}
