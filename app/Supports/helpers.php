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
