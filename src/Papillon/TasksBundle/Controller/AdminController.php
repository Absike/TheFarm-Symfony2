<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class AdminController
 * @package Papillon\TasksBundle\Controller
 */
class AdminController extends Controller
{

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
