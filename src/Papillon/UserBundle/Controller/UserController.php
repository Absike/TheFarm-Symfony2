<?php

namespace Papillon\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{

    public function indexAction()
    {
        return $this->render('PapillonUserBundle:User:index.html.twig', array());
    }
}
