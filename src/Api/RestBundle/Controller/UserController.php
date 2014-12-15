<?php

namespace Api\RestBundle\Controller;

use Papillon\UserBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    /**
     * @Rest\View
     */
    public function allAction()
    {
        $oUser = $this->getDoctrine()->getRepository("PapillonUserBundle:User")->findAll();

        if(!$oUser)
        {
            throw $this->createNotFoundException('No user found.');
        }

        return $oUser;
    }

    /**
     * @param User $user
     * @Rest\View
     */
    public function getAction(User $user)
    {
        $oUser = $this->getDoctrine()->getRepository("PapillonUserBundle:User")->find($user);
        return $oUser;
    }

}
