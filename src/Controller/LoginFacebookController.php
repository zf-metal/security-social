<?php

namespace ZfMetal\SecuritySocial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfMetal\SecuritySocial\Options\ModuleOptions;

class LoginFacebookController extends AbstractActionController
{

    /**
     *
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * @var ModuleOptions
     */
    private $options;

    /**
     * @return ModuleOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * LoginController constructor.
     * @param \Zend\Authentication\AuthenticationService $authService
     * @param ModuleOptions $options
     */
    public function __construct(\Zend\Authentication\AuthenticationService $authService, ModuleOptions $options)
    {
        $this->authService = $authService;
        $this->options = $options;
    }

    /**
     * getAuthService
     * @return \Zend\Authentication\AuthenticationService
     */
    function getAuthService()
    {
        return $this->authService;
    }

    function setAuthService(\Zend\Authentication\AuthenticationService $authService)
    {
        $this->authService = $authService;
    }


}
