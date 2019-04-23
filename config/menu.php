<?php

return [

    'web' => [
        'id' => 1,
        'name' => '前台管理',
        'slug' => 'web',
        'parent_id' => 0,
        'level' => 0,
        'children' => [
            [
                'id' => 2,
                'name' => '话题管理',
                'slug' => 'topic_manage',
                'parent_id' => 1,
                'level' => 1,
                'children' => [
                    ['id' => 21, 'name' => '添加话题', 'slug' => 'topic_create', 'parent_id' => 2, 'level' => 2, 'children' => [],],
                    ['id' => 22, 'name' => '编辑话题', 'slug' => 'topic_update', 'parent_id' => 2, 'level' => 2, 'children' => [],],
                    ['id' => 23, 'name' => '删除话题', 'slug' => 'topic_delete', 'parent_id' => 2, 'level' => 2, 'children' => [],],
                ],
            ],
            [
                'id' => 3,
                'name' => '回复管理',
                'slug' => 'reply_manage',
                'parent_id' => 1,
                'level' => 1,
                'children' => [
                    ['id' => 31, 'name' => '添加回复', 'slug' => 'reply_create', 'parent_id' => 3, 'level' => 2, 'children' => [],],
                    ['id' => 32, 'name' => '删除回复', 'slug' => 'reply_delete', 'parent_id' => 3, 'level' => 2, 'children' => [],],
                ],
            ],
        ],
    ],

    'admin' => [
        'id' => 10,
        'name' => '后台管理',
        'slug' => 'admin',
        'parent_id' => 0,
        'level' => 0,
        'uri' => '',
        'is_show' => true,
        'children' => [
            'user' => [
                'id' => 100,
                'name' => '用户',
                'slug' => 'user',
                'parent_id' => 10,
                'level' => 1,
                'uri' => 'admin.users.index',
                'is_show' => true,
                'children' => [
                    [
                        'id' => 101,
                        'name' => '用户管理',
                        'slug' => 'user_manage',
                        'parent_id' => 100,
                        'level' => 2,
                        'uri' => 'admin.users.index',
                        'is_show' => true,
                        'children' => [
                            ['id' => 201, 'name' => '用户列表', 'slug' => 'user_list', 'parent_id' => 101, 'level' => 3, 'uri' => 'admin.users.index', 'is_show' => true, 'children' => []],
                            ['id' => 202, 'name' => '添加用户', 'slug' => 'user_create', 'parent_id' => 101, 'level' => 3, 'uri' => 'admin.users.create', 'is_show' => false, 'children' => []],
                            ['id' => 203, 'name' => '编辑用户', 'slug' => 'user_update', 'parent_id' => 101, 'level' => 3, 'uri' => 'admin.users.edit', 'is_show' => false, 'children' => []],
                            ['id' => 204, 'name' => '查看用户', 'slug' => 'user_detail', 'parent_id' => 101, 'level' => 3, 'uri' => 'admin.users.show', 'is_show' => false, 'children' => []],
                            ['id' => 205, 'name' => '删除用户', 'slug' => 'user_delete', 'parent_id' => 101, 'level' => 3, 'uri' => 'admin.users.destroy', 'is_show' => false, 'children' => []],
                        ],
                    ],
                    [
                        'id' => 102,
                        'name' => '私信管理',
                        'slug' => 'letter_manage',
                        'parent_id' => 100,
                        'level' => 2,
                        'uri' => '',
                        'is_show' => true,
                        'children' => [],
                    ],
                ],
            ],
            'run' => [
                'id' => 110,
                'name' => '运营',
                'slug' => 'run',
                'parent_id' => 10,
                'level' => 1,
                'uri' => 'admin.operations.index',
                'is_show' => true,
                'children' => [
                    [
                        'id' => 111,
                        'name' => '运营管理一',
                        'slug' => 'run1',
                        'parent_id' => 110,
                        'level' => 2,
                        'is_show' => true,
                        'children' => [
                        ],
                    ],
                    [
                        'id' => 112,
                        'name' => '运营管理二',
                        'slug' => 'run2',
                        'parent_id' => 110,
                        'level' => 2,
                        'is_show' => true,
                        'children' => [
                        ],
                    ],
                ],
            ],
            'system' => [
                'id' => 190,
                'name' => '系统',
                'slug' => 'system',
                'parent_id' => 10,
                'level' => 1,
                'uri' => 'admin.settings.sites.show',
                'is_show' => true,
                'children' => [
                    [
                        'id' => 191,
                        'name' => '站点设置',
                        'slug' => 'setting_site',
                        'parent_id' => 190,
                        'level' => 2,
                        'uri' => 'admin.settings.sites.show',
                        'is_show' => true,
                        'children' => [
                            ['id' => 291, 'name' => '基本信息', 'slug' => 'site_show', 'parent_id' => 191, 'level' => 3, 'uri' => 'admin.settings.sites.show', 'is_show' => true, 'children' => []],
                            ['id' => 292, 'name' => '友情链接', 'slug' => 'site_link', 'parent_id' => 191, 'level' => 3, 'uri' => 'admin.settings.links.index', 'is_show' => true, 'children' => []],
                        ],
                    ],
                    [
                        'id' => 192,
                        'name' => '用户设置',
                        'slug' => 'setting_user',
                        'parent_id' => 190,
                        'level' => 2,
                        'uri' => 'admin.settings.users.register',
                        'is_show' => true,
                        'children' => [
                            ['id' => 391, 'name' => '注册', 'slug' => 'user_register', 'parent_id' => 191, 'level' => 3, 'uri' => 'admin.settings.users.register', 'is_show' => true, 'children' => []],
                            ['id' => 392, 'name' => '登录', 'slug' => 'user_login', 'parent_id' => 191, 'level' => 3, 'uri' => 'admin.settings.users.login', 'is_show' => true, 'children' => []],
                        ],
                    ],
                    [
                        'id' => 193,
                        'name' => '角色管理',
                        'slug' => 'setting_role',
                        'parent_id' => 190,
                        'level' => 2,
                        'uri' => 'admin.roles.index',
                        'is_show' => true,
                        'children' => [
                        ],
                    ],
                    [
                        'id' => 194,
                        'name' => '系统管理',
                        'slug' => 'system_manager',
                        'parent_id' => 190,
                        'level' => 2,
                        'uri' => 'admin.systems.inspections.index',
                        'is_show' => true,
                        'children' => [
                            ['id' => 591, 'name' => '系统自检', 'slug' => 'system_inspection', 'parent_id' => 194, 'level' => 3, 'uri' => 'admin.systems.inspections.index', 'is_show' => true, 'children' => []],
                            ['id' => 592, 'name' => '系统命令', 'slug' => 'system_artisan', 'parent_id' => 194, 'level' => 3, 'uri' => 'admin.systems.artisans.index', 'is_show' => true, 'children' => []],
                        ],
                    ],
                ],
            ],
        ],
    ],

];
