<?php

namespace Papillon\TasksBundle\Controller;

use Papillon\UserBundle\Form\AccountType;
use Papillon\UserBundle\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class AccountController extends Controller
{
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

            /*
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $newSalt = md5(uniqid());
            $user->setSalt($newSalt);
            $user->setPassword($encoder->encodePassword($pass_form['password']->getData(), $newSalt));*/

            $user->setPlainPassword($pass_form['password']->getData());
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user, true);

            $this->get('session')->getFlashBag()->add('success', 'Your password has been updated.');
            return $this->redirect($this->generateUrl('account'));
        }

        return $this->render('PapillonTasksBundle:Users:account.html.twig', array(
            'account_form' => $account_form->createView(),
            'pass_form'    => $pass_form->createView(),
        ));

    }
}
