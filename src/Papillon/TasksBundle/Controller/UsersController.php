<?php

namespace Papillon\TasksBundle\Controller;

use Papillon\UserBundle\Entity\User;
use Papillon\UserBundle\Form\UserType;
use Papillon\UserBundle\Form\AccountType;
use Papillon\UserBundle\Form\ChangePasswordType;
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
     * @Route("/myaccount",name="account")
     */
    public function accountAction(Request $request){

        $user = $this->get('security.context')->getToken()->getUser();

        $account_form = $this->createForm(new AccountType(), $user);
        $pass_form = $this->createForm(new ChangePasswordType());

        // Was the form submitted?
        if ($request->isMethod('POST')) {
            $account_form->handleRequest($request);

            if ($account_form->isValid()) {

                // Save the user
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Redirect the user
                $this->get('session')->getFlashBag()->add('success', 'Your profile has been updated.');
                return $this->redirect($this->generateUrl('account'));
            }
        }

        return $this->render('PapillonTasksBundle:Users:account.html.twig', array(
            'account_form' => $account_form->createView(),
            'pass_form'    => $pass_form->createView(),
        ));
    }

    /**
     * @Route("/account_update_pass",name="update_pass")
     */
    public function changePasswdAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $account_form = $this->createForm(new AccountType(), $user);
        $pass_form = $this->createForm(new ChangePasswordType(),$user);

        $pass_form->handleRequest($request);

        if ($pass_form->isSubmitted() && $pass_form->isValid()) {

            $encoder = $this->get('security.encoder_factory')->getEncoder($user);

            $newSalt = md5(uniqid());
            $user->setSalt($newSalt);
            $user->setPassword($encoder->encodePassword($pass_form['password']->getData(), $newSalt));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Your password has been updated.');
            return $this->redirect($this->generateUrl('account'));
        }

        return $this->render('PapillonTasksBundle:Users:account.html.twig', array(
            'account_form' => $account_form->createView(),
            'pass_form'    => $pass_form->createView(),
        ));

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
