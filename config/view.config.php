<?php

namespace ZfMetal\SecuritySocial;

return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'getSecuritySocialOptions' => Factory\Helper\View\GetModuleOptionsFactory::class,
        ],
        'invokables' => [
        ]
    ],
    'view_helper_config' => array(
    ),
];
