<?php

namespace ZfMetal\SecuritySocial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfMetal\SecuritySocial\Options\ModuleOptions;

class LoginFacebookController extends AbstractActionController {

    /**
     *
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * @var \Facebook\Facebook
     */
    private $fb;

    /**
     * @var \ZfMetal\SecuritySocial\Options\ModuleOptions
     */
    private $moduleOptions;

    /**
     * LoginFacebookController constructor.
     * @param \Facebook\Facebook $fb
     * @param ModuleOptions $moduleOptions
     */
    public function __construct(\Zend\Authentication\AuthenticationService $authService, \Facebook\Facebook $fb, ModuleOptions $moduleOptions) {
        $this->authService = $authService;
        $this->fb = $fb;
        $this->moduleOptions = $moduleOptions;
    }

    /**
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthService() {
        return $this->authService;
    }

    /**
     * @return \Facebook\Facebook
     */
    public function getFb() {
        return $this->fb;
    }

    /**
     * @param \Facebook\Facebook $fb
     */
    public function setFb($fb) {
        $this->fb = $fb;
    }

    /**
     * @return ModuleOptions
     */
    public function getModuleOptions() {
        return $this->moduleOptions;
    }

    /**
     * @param ModuleOptions $moduleOptions
     */
    public function setModuleOptions($moduleOptions) {
        $this->moduleOptions = $moduleOptions;
    }

    public function loginAction() {
        if (!$this->getModuleOptions()->getFacebookLogin()) {
            $this->redirect()->toRoute('home');
        }

        $helper = $this->getFb()->getRedirectLoginHelper();
        $permisos = ['email'];
        $url = $this->url()->fromRoute('zf-metal.user-fb/login_callback', [], ['force_canonical'=>true]);
        $loginUrl = $helper->getLoginUrl($url, $permisos);

        $this->redirect()->toUrl($loginUrl);
    }

    public function loginCallbackAction() {
        if (!$this->getModuleOptions()->getFacebookLogin()) {
            $this->redirect()->toRoute('home');
        }

        $helper = $this->getFb()->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if ($accessToken) {
            $this->getFb()->setDefaultAccessToken((string) $accessToken);
            $userData = $this->getFb()->get('/me?locale=en_US&fields=name,email', $accessToken)->getGraphGroup();

            $this->getAuthService()->getAdapter()->setUserData($userData);
            $result = $this->getAuthService()->authenticate();

            if ($result->getCode() == 1) {
                if ($this->getSecurityOptions()->getRedirectStrategy()->getAppendPreviousUri()) {
                    $uri = $this->getSecurityOptions()->getRedirectStrategy()->getPreviousUriQueryKey();
                    if ($this->sessionManager()->has($uri)) {
                        $route = $this->sessionManager()->getFlash($uri);
                        return $this->redirect()->toRoute($route);
                    }
                }
                return $this->redirect()->toRoute('home');
            }

            foreach ($result->getMessages() as $mensaje) {
                $this->flashMessenger()->addErrorMessage($mensaje);
            }
        }

        return $this->redirect()->toRoute('zf-metal.user/login');
    }

    public function logoutFacebook() {
        $this->getFb()->get('email');
    }

}
