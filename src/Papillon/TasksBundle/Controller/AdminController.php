<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{

    /**
     * @Route("/tasks", name="all_tasks")
     * @Template("PapillonTasksBundle:Admin:tasks.html.twig")
     */
    public function allTasksAction()
    {
        $em = $this->getDoctrine()->getManager();

        return array(
            'tasks' => $em->getRepository('PapillonTasksBundle:Tasks')->findAll()
        );
    }

    /**
     * @Route("/users",name="users")
     * @Template("PapillonTasksBundle:Users:index.html.twig")
     */
    public function indexAction(Request $request)
    {

        /*$oUsers = $this->getDoctrine()->getRepository('PapillonUserBundle:User')->getAllUser();
        $paginator  = $this->get('knp_paginator');

        $usersPagination = $paginator->paginate(
            $oUsers,
            $request->query->get('page', 1),
            $this->container->getParameter('max_users_per_page')
        );*/

        $oUsers = $this->getDoctrine()->getRepository('PapillonUserBundle:User')->findAll();
        return $this->render('PapillonTasksBundle:Users:index.html.twig', array('pUsers' => $oUsers));
    }

    /**
     * @Route("/bootstrap" , name="bootstrap")
     * @Template("PapillonTasksBundle:Stuff:bootstrap.html.twig")
     */
    public function bootstrapAction()
    {
        return array();
    }


    /**
     * @Route("/forms" , name="forms")
     * @Template("PapillonTasksBundle:Stuff:forms.html.twig")
     */
    public function formsAction()
    {
        return array();
    }

}
