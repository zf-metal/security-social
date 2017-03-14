<?php

namespace ZfMetal\SecuritySocial;

return array_merge(
    include 'doctrine.config.php',
    include 'router.config.php',
    include 'controller.config.php',
    include 'plugins.config.php',
    include 'view.config.php',
    include 'services.config.php',
    include 'options.config.php',
    include 'facebook.config.php'
);