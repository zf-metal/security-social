<?php

namespace ZfMetal\SecuritySocial;

return [
    'controllers' => [
        'factories' => [
            Controller\LoginFacebookController::class => Factory\Controller\LoginFacebookControllerFactory::class,
        ]
    ]
];
