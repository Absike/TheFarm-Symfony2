<?php

namespace Papillon\TasksBundle\Controller;

use Papillon\TasksBundle\Entity\Customers;
use Papillon\TasksBundle\Form\CustomersType;
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
        $client = new Customers();
        $form = $this->createForm(new CustomersType(), $client);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Customer added.');
            return $this->redirect($this->generateUrl('customers'));
        }

        return $this->render('PapillonTasksBundle:Customers:new.html.twig', array(
            'entity' => $client,
            'form' => $form->createView(),
        ));
    }

}
