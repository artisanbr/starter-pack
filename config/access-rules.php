<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

return [
    'roles' => [
        'root' => [
            'name'         => 'root',
            'display_name' => 'Root Developer',
            'description'  => 'DIO',
            'color'        => 'primary',
            'permissions'  => [],
        ],

        'admin' => [
            'name'         => 'admin',
            'display_name' => 'Administrador',
            'description'  => 'Responsável geral da plataforma',
            'color'        => 'ascent',
            'permissions'  => [],
        ],

        'mod' => [
            'name'         => 'mod',
            'display_name' => 'Moderador',
            'description'  => 'Staff da plataforma',
            'color'        => 'info',
            'permissions'  => [
                'users'    => ['create', 'read', 'update', 'ban', 'unban', 'mute', 'unmute'],
                'pages'    => [],
                'articles' => [],
                'snippets' => [],
            ],
        ],

        'user' => [
            'name'         => 'user',
            'display_name' => 'Usuário',
            'description'  => 'Usuário da plataforma',
            'color'        => 'secondary',
            'permissions'  => [
                'articles' => ['list', 'create', 'read', 'update'],
                'snippets' => ['list', 'create', 'read', 'update'],
            ],
        ],

        /*'guest' => [
            'name'         => 'guest',
            'display_name' => 'Visitante',
            'description'  => 'Visitante da plataforma',
        ],*/
    ],

    'permissions' => [
        'models' => [
            'users'       => ['ban', 'unban', 'mute', 'unmute'],
            'roles'       => ['assign', 'unassign'],
            'permissions' => ['assign', 'unassign'],
            'pages'       => ['publish', 'unpublish'],
            'articles'    => ['publish', 'unpublish'],
            'snippets'    => ['pin'],
        ],

        'actions' => ['list', 'create', 'read', 'update', 'delete'],
    ],

    /*'role_permission' => [
        'admin' => [],

        'mod' => [
            'users'    => ['create', 'read', 'update', 'ban', 'unban', 'mute', 'unmute'],
            'pages'    => [],
            'articles' => [],
            'snippets' => [],
        ],

        'user' => [
            'articles' => ['list', 'create', 'read', 'update'],
            'snippets' => ['list', 'create', 'read', 'update'],
        ],
    ],
    'role_color' => [
        'root'  => 'primary',
        'admin' => 'ascent',
        'mod'   => 'info',
        'user'  => 'secondary',
    ],*/
];
