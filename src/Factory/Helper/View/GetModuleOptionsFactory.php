<?php

namespace ZfMetal\SecuritySocial\Factory\Helper\View;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class GetModuleOptionsFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $moduleOptions = $container->get('zf-metal-security-social.options');
        return new \ZfMetal\SecuritySocial\Helper\View\GetModuleOptions($moduleOptions);
    }

}
