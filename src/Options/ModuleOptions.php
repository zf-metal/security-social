<?php

namespace ZfMetal\SecuritySocial\Options;

use Zend\Stdlib\AbstractOptions;
/**
 */
class ModuleOptions extends AbstractOptions
{
    /**
     * @var boolean
     */
    private $facebookLogin;

    /**
     * Constructor
     */
    public function __construct($options = null)
    {
        $this->__strictMode__ = false;
        parent::__construct($options);
    }

    /**
     * @return mixed
     */
    public function getFacebookLogin()
    {
        return $this->facebookLogin;
    }

    /**
     * @param mixed $facebookLogin
     */
    public function setFacebookLogin($facebookLogin)
    {
        $this->facebookLogin = $facebookLogin;
    }


}
