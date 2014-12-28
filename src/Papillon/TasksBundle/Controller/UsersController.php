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
    public function indexAction(Request $request)
    {

        $oUsers = $this->getDoctrine()->getRepository('PapillonUserBundle:User')->getAllUser();
        $paginator  = $this->get('knp_paginator');

        $usersPagination = $paginator->paginate(
            $oUsers,
            $request->query->get('page', 1),
            $this->container->getParameter('max_users_per_page')
        );

        return $this->render('PapillonTasksBundle:Users:index.html.twig', array('pUsers' => $usersPagination));
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
