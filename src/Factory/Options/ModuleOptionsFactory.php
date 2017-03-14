<?php

namespace ZfMetal\SecuritySocial\Factory\Options;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class ModuleOptionsFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
         $config = $container->get('Config');
         
         return new \ZfMetal\SecuritySocial\Options\ModuleOptions(isset($config['zf-metal-security-social.options']) ? $config['zf-metal-security-social.options'] : array());
    }

}
