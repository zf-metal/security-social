<?php

namespace ZfMetal\SecuritySocial\Factory\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class FacebookAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get('doctrine.entitymanager.orm_default');
        $moduleOptions = $container->get('zf-metal-security.options');
        return new \ZfMetal\SecuritySocial\Adapter\Facebook($em, $moduleOptions);
    }
}