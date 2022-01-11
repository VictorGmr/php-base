<?php

namespace Modules\SystemConfig\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'user',
                'title' => 'Usuário',
                'sub_menu' => [
                    'user-create' => [
                        'icon' => '',
                        'route_name' => 'user-create',
                        'params' => [],
                        'title' => 'Cadastrar'
                    ],
                    'user-list' => [
                        'icon' => '',
                        'route_name' => 'user-list',
                        'params' => [],
                        'title' => 'Listar'
                    ],
                ]
            ],[
                'icon' => 'user',
                'title' => 'Empresa',
                'sub_menu' => [
                    'company-create' => [
                        'icon' => '',
                        'route_name' => 'company-create',
                        'params' => [],
                        'title' => 'Cadastrar'
                    ],
                    'company-list' => [
                        'icon' => '',
                        'route_name' => 'company-list',
                        'params' => [],
                        'title' => 'Listar'
                    ],
                ]
            ],[
                'icon' => 'user',
                'title' => 'Aplicação',
                'sub_menu' => [
                    'application-create' => [
                        'icon' => '',
                        'route_name' => 'application-create',
                        'params' => [],
                        'title' => 'Cadastrar'
                    ],
                    'application-list' => [
                        'icon' => '',
                        'route_name' => 'application-list',
                        'params' => [],
                        'title' => 'Listar'
                    ],
                ]
            ],[
                'icon' => 'user',
                'title' => 'Modulo',
                'sub_menu' => [
                    'module-create' => [
                        'icon' => '',
                        'route_name' => 'module-create',
                        'params' => [],
                        'title' => 'Cadastrar'
                    ],
                    'application-list' => [
                        'icon' => '',
                        'route_name' => 'module-list',
                        'params' => [],
                        'title' => 'Listar'
                    ],
                ]
            ]

        ];
    }
}
