<?php

namespace Papillon\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DashboardController
 * @Route("dashboard")
 * @package Papillon\UserBundle\Controller
 */
class DashboardController extends Controller
{
    /**
     * @Route("/home" , name="dashboard")
     * @Template("PapillonUserBundle:Dashboard:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }


    /**
     * @Route("/customers" , name="customers")
     * @Template("PapillonUserBundle:Dashboard:customers.html.twig")
     */
    public function customersAction()
    {
        return array();
    }

    /**
     * @Route("/projects" , name="projects")
     * @Template("PapillonUserBundle:Dashboard:projects.html.twig")
     */
    public function projectsAction()
    {
        return array();
    }

}
