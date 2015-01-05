<?php

namespace Api\RestBundle\Controller;

use Papillon\UserBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;

class UserController extends Controller
{


    /**
     * Get single Page,
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "List of all users",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when any user is not found"
     *   }
     * )
     *
     * @Rest\View
     */
    public function allAction()
    {
        $oUser = $this->getDoctrine()->getRepository("PapillonUserBundle:User")->findAll();

        if(!$oUser){
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
