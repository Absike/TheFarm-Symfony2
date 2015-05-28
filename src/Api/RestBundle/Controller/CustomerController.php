<?php

namespace Api\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller {


    /**
     * @Rest\View
     */
    public function allAction()
    {
        $oCustomers = $this->getDoctrine()->getRepository("PapillonTasksBundle:Customers")->findAll();

        if(!$oCustomers)
        {
            throw $this->createNotFoundException('No Customers found.');
        }

        return $oCustomers;
    }


} 