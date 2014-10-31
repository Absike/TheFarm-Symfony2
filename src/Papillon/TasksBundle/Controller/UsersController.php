<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UsersController
 * @package Papillon\TasksBundle\Controller
 */
class UsersController extends Controller
{

    /**
     * @Route("/users",name="users")
     * @Template("PapillonTasksBundle:Users:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/users/new", name="new_user")
     * @Template("PapillonTasksBundle:Users:new.html.twig")
     */
    public function newAction(Request $request)
    {
        return array();
    }

}
