<?php

namespace ZfMetal\SecuritySocial\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LoginFacebookControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $authService = $container->get('zf-metal-security.authservice');
        $moduleOptions = $container->get('zf-metal-security-social.options');
        return new \ZfMetal\SecuritySocial\Controller\LoginFacebookController($authService, $moduleOptions);
    }

}
