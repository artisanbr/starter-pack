<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

return [
    'sidebar' => [
        [
            'type' => 'item',
            'text' => 'Painel de Controle',
            'url'  => '/',
            'icon' => 'o-sparkles',
        ],
        [
            'type'  => 'submenu',
            'text'  => 'Administração',
            'icon'  => 'clarity.administrator-line',
            'role'  => [''],
            'items' => [
                [
                    'type'  => 'submenu',
                    'text'  => 'Regras de Acesso',
                    'icon'  => 'eos.admin-panel-settings-o',
                    'role'  => ['root'],
                    'items' => [
                        [
                            'type' => 'item',
                            'text' => 'Grupos',
                            'url'  => 'dashboard.access-rules.roles.index',
                            'icon' => 'clarity.employee-group-line',
                        ],
                        [
                            'type' => 'item',
                            'text' => 'Permissões',
                            'url'  => 'dashboard.access-rules.permissions.index',
                            'icon' => 'fas.shield-halved',
                        ],
                    ],
                ],
                [
                    'type'  => 'submenu',
                    'text'  => 'Usuários',
                    'icon'  => 's-user-group',
                    'role'  => [''],
                    'items' => [
                        [
                            'text' => 'Listar Usuários',
                            'url'  => 'dashboard.users.index',
                            'icon' => 'o-users',
                        ],
                        [
                            'text' => 'Novo Usuário',
                            'url'  => 'dashboard.users.create',
                            'icon' => 's-user-plus',
                        ],
                    ],
                ],
            ],
        ],

    /**
     * Item Properties:
        [
            'type' => 'item', //item (default), submenu, header
            'text' => '',
            'url' => '', //url or route()
            'role' => null,
            'icon' => null,
            'permission' => null,
            'click' => null
        ],
     */
    ],
    'header' => [],
];
