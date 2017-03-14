<?php

namespace ZfMetal\SecuritySocial;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'zf-metal.user-fb' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/user'
                ],
                'child_routes' => [
                    'login' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/login-facebook',
                            'defaults' => [
                                'controller' => Controller\LoginFacebookController::class,
                                'action' => 'login'
                            ]
                        ]
                    ],
                    'login_callback' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/login-facebook-callback',
                            'defaults' => [
                                'controller' => Controller\LoginFacebookController::class,
                                'action' => 'login-callback'
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ]
];
