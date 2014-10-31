<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProjectsController
 * @package Papillon\TasksBundle\Controller
 */
class ProjectsController extends Controller
{

    /**
     * @Route("/projects" , name="projects")
     * @Template("PapillonTasksBundle:Projects:index.html.twig")
     */
    public function projectsAction()
    {
        return array();
    }

    /**
     * @Route("/projects/new", name="new_project")
     * @Template("PapillonTasksBundle:Projects:new.html.twig")
     */
    public function newAction(Request $request)
    {
        return array();
    }

}
