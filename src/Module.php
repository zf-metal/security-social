<?php

namespace ZfMetal\SecuritySocial;
use Zend\EventManager\EventInterface;

class Module {

    const VERSION = '3.0.2dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }
}
