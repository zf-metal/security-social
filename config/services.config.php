<?php

namespace ZfMetal\SecuritySocial;

use Gedmo\Tree\Strategy;
use Prophecy\Comparator\Factory;

return [
    'service_manager' => [
        'factories' => [
            'zf-metal-security-social.options' => \ZfMetal\SecuritySocial\Factory\Options\ModuleOptionsFactory::class,
            Adapter\Facebook::class => \ZfMetal\SecuritySocial\Factory\Adapter\FacebookAdapterFactory::class,
            'zf-metal-security.authservice-social' => \ZfMetal\SecuritySocial\Factory\Services\AuthServiceFactory::class,
        ],
        'aliases' => [
        ]
    ]
];

