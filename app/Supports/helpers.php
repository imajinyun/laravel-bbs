<?php

if (! function_exists('route_class')) {
    /**
     * 将路由名称转换为页面 div class 名称
     *
     * @return string
     */
    function route_class()
    {
        return str_replace('.', '-', \Illuminate\Support\Facades\Route::currentRouteName());
    }
}

if (! function_exists('nav_active_class')) {
    /**
     * 通过分类 ID 获取激活的类
     *
     * @param int $category_id
     *
     * @return string
     */
    function nav_active_class($category_id)
    {
        return active_class(
            if_route('categories.show') &&
            if_route_param('category', $category_id)
        );
    }
}

if (! function_exists('make_excerpt')) {
    /**
     * 根据给定的内容生成摘要
     *
     * @param string $text
     * @param int $length
     *
     * @return string
     */
    function make_excerpt($text, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($text)));

        return str_limit($excerpt, $length);
    }
}

if (! function_exists('upload_token')) {
    /**
     * 生成上传文件令牌
     *
     * @param string $group
     * @param string $type
     * @param int $duration
     *
     * @return string
     */
    function upload_token($group, $type = 'image', $duration = 14400)
    {
        $uploadToken = new \App\Supports\UploadToken();

        return $uploadToken->make($group, $type, $duration);
    }
}
