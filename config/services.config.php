<?php

namespace ZfMetal\SecuritySocial;

use Gedmo\Tree\Strategy;
use Prophecy\Comparator\Factory;

return [
    'service_manager' => [
        'factories' => [
            'zf-metal-security-social.options' => \ZfMetal\SecuritySocial\Factory\Options\ModuleOptionsFactory::class,
        ],
        'aliases' => [
        ]
    ]
];

