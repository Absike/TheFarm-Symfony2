<?php

namespace Papillon\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TaskController extends Controller
{

    /**
     * @Route("/tasks", name="tasks")
     * @Template("PapillonUserBundle:Task:task.html.twig")
     */
    public function taskAction()
    {
        return array();
    }



    /**
     * @Route("/alert", name="alert")
     * @Template("PapillonUserBundle:Task:alert.html.twig")
     */
    public function alertAction()
    {
        return array();
    }
}
