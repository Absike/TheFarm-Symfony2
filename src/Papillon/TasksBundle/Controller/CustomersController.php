<?php

namespace Papillon\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CustomersController
 * @package Papillon\TasksBundle\Controller
 */
class CustomersController extends Controller
{

    /**
     * @Route("/customers" , name="customers")
     * @Template("PapillonTasksBundle:Customers:index.html.twig")
     */
    public function customersAction()
    {
        return array();
    }

    /**
     * @Route("/customers/new", name="new_customer")
     * @Template("PapillonTasksBundle:Customers:new.html.twig")
     */
    public function newAction(Request $request)
    {
        return array();
    }

}
