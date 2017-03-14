<?php

namespace ZfMetal\SecuritySocial\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;

class Facebook implements AdapterInterface
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Facebook\GraphNodes\GraphGroup
     */
    private $userData;

    /**
     * @var \ZfMetal\Security\Options\ModuleOptions
     */
    private $moduleOptions;

    /**
     * Facebook constructor.
     * @param \Doctrine\ORM\EntityManager $em
     * @param \ZfMetal\Security\Options\ModuleOptions $moduleOptions
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, \ZfMetal\Security\Options\ModuleOptions $moduleOptions)
    {
        $this->em = $em;
        $this->moduleOptions = $moduleOptions;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    function getEm()
    {
        return $this->em;
    }

    /**
     * @param $em \Doctrine\ORM\EntityManager
     */
    function setEm(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return \Facebook\GraphNodes\GraphGroup
     */
    public function getUserData()
    {
        return $this->userData;
    }

    /**
     * @param \Facebook\GraphNodes\GraphGroup $userData
     */
    public function setUserData($userData)
    {
        $this->userData = $userData;
    }

    /**
     * @return \ZfMetal\Security\Options\ModuleOptions
     */
    public function getModuleOptions()
    {
        return $this->moduleOptions;
    }

    public function getEmail()
    {
        return $this->getUserData()->getEmail();
    }

    /**
     * Authenticate
     *
     * @return \Zend\Authentication\Result
     */
    public function authenticate()
    {

        $identity = $this->getEm()->getRepository('ZfMetal\Security\Entity\User')
            ->findOneByEmail($this->getEmail());

        $code = 0;

        if ($identity) {
            //Forzamos la obtencion de Roles.
            $identity->getRoles()->getValues();
            if (!$identity->isActive()) {
                $mensaje = ['Falla al autenticar, usuario inactivo'];
            } else {
                $mensaje = ['Usuario logueado exitosamente'];
                $code = 1;
            }
        } else {
            $identity = $this->createUser();
            $mensaje = ['Usuario logueado exitosamente'];
            $code = 1;
        }

        return new \Zend\Authentication\Result($code, $identity, $mensaje);
    }

    public function createUser()
    {
        $user = new \ZfMetal\Security\Entity\User();
        $user->setEmail($this->getUserData()->getEmail());
        $user->setName($this->getUserData()->getName());
        $user->setActive(true);
        $user->setUsername(substr($this->getUserData()->getEmail(),0, strpos($this->getUserData()->getEmail(),'@')));
        $user->setPassword('facebook');

        $photoLink = "http://graph.facebook.com/" . $this->getUserData()->getId() . "/picture?type=large";
        $date = new \DateTime();
        $pictureName = $date->format('Y-m-d\TH:i:s.u') . rand(1, 999);
        $resultPictureCopy = copy($photoLink, $this->getModuleOptions()->getProfilePicturePath() . $pictureName);

        if ($resultPictureCopy) {
            $user->setImg($pictureName);
        }

        $this->getEm()->getRepository('ZfMetal\Security\Entity\User')
            ->saveUser($user);

        return $user;
    }
}
