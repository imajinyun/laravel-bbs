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

if (! function_exists('filepath')) {
    function filepath($uri, $default = null)
    {
        return \App\Supports\FilePath::getFilePath($uri, $default);
    }
}

if (! function_exists('each_tree_menu')) {
    /**
     * 树结构菜单选中项处理
     *
     * @param array $menu
     * @param array $ids
     * @param bool $flag
     *
     * @return array
     */
    function each_tree_menu(array & $menu, array $ids, $flag = false)
    {
        if (is_array($menu)) {
            foreach ($menu as $key => & $item) {
                if (isset($item['children'])) {
                    if (in_array((int) $item['id'], $ids, true)) {
                        $item['checked'] = true;
                    }

                    if ($flag) {
                        $item['chkDisabled'] = true;
                    }
                    each_tree_menu($item['children'], $ids, $flag);
                }
            }
        }

        return $menu;
    }
}

if (! function_exists('get_children_menu')) {
    function get_children_menu($menu, $node, $level = 0)
    {
        static $result = [];
        if (is_array($menu)) {
            foreach ($menu as $key => $item) {
                if ($item['slug'] === $node) {
                    if ((string) $item['slug'] === $node) {
                        $result = $item['children'];
                    }
                } else {
                    get_children_menu($item['children'], $node);
                }
            }
        }

        return $result;
    }
}

if (! function_exists('menu_filter')) {
    function menu_filter($menu, $column)
    {
        $menu = collect(array_column($menu, $column))
            ->filter(static function ($value) {
                if (false !== $pos = strrpos($value, '.')) {
                    $haystack = ['update', 'edit', 'show', 'destroy'];
                    $string = substr($value, $pos + 1);

                    if (! in_array($string, $haystack, true)) {
                        return $value;
                    }
                }
            })
            ->map(static function ($value) {
                return $value ? route($value) : '';
            })
            ->toArray();

        return $menu;
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($size, $delimiter = '')
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $count = count($units);
        for ($i = 0; $size >= 1024 && $i < $count; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . $delimiter . $units[$i];
    }
}

if (! function_exists('select_options')) {
    function select_options(array $choices, $selected = null, $options = null)
    {
        $html = '';

        if ($options !== null) {
            if (is_array($options)) {
                foreach ($options as $key => $val) {
                    $html .= "<option value='{$key}'>{$val}</option>";
                }
            } else {
                $html .= "<option value=''>{$options}</option>";
            }
        }

        foreach ($choices as $value => $choice) {
            if ((string) trim($selected) === (string) $value) {
                $html .= "<option value='{$value}' selected>{$choice}</option>";
            } else {
                $html .= "<option value='{$value}'>{$choice}</option>";
            }
        }

        return $html;
    }
}
