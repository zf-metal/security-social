<?php

namespace ZfMetal\SecuritySocial\Options;

use Zend\Stdlib\AbstractOptions;
/**
 */
class ModuleOptions extends AbstractOptions
{

    /**
     * Constructor
     */
    public function __construct($options = null)
    {
        $this->__strictMode__ = false;
        parent::__construct($options);
    }

}
