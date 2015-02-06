<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DashboardController
 * @Route("dashboard")
 * @package Papillon\TasksBundle\Controller
 */
class DashboardController extends Controller
{
    /**
     * @Route("/home" , name="dashboard")
     * @Template("PapillonTasksBundle:Dashboard:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }


}
