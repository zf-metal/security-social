<?php

namespace ZfMetal\SecuritySocial\Factory\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LoginFacebookControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $config = $container->get('config');
        $fb = new \Facebook\Facebook($config['facebook']);
        $moduleOptions = $container->get('zf-metal-security-social.options');
        $authService = $container->get('zf-metal-security.authservice-social');
        return new \ZfMetal\SecuritySocial\Controller\LoginFacebookController($authService,$fb, $moduleOptions);
    }

}
