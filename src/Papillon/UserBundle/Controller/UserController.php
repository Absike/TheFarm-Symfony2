<?php

namespace Papillon\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class UserController extends Controller
{

    /**
     * @Route("/users",name="users")
     * @Template("PapillonUserBundle:User:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
