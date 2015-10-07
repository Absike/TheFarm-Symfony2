<?php

namespace Papillon\UserBundle\Controller;

use Papillon\UserBundle\Entity\User;
use Papillon\UserBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use FOS\UserBundle\Controller\SecurityController as BaseController;

/**
 * @Route("/secured")
 */
class SecurityController  extends BaseController
{

    /**
     * @Route("/login", name="login")
     * @Template("PapillonUserBundle:User:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        //$form_signup = $this->createForm(new UserType());

        $response = parent::loginAction($request);

        //do something else;

        return $response;

    }


   /* public function signUpAction(Request $request)
    {
        $user = new User();
        $form_signup = $this->createForm(new UserType(),$user);

        if ($request->isMethod('POST') && $form_signup->submit($request)->isValid()) {

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $user->encodePassword($encoder);

                //Temporary add role to user
                $user->addGroup($this->getDoctrine()->getRepository('PapillonUserBundle:Group')->findOneByName('User'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $html = $this->renderView('PapillonTasksBundle:Stuff:email.html.twig', array('message' => 'Your account has been created.'));
                $this->get('mail_helper')->sendEmail('absike@gmail.com', $html, 'Welcome to papillon v2');

                $this->get('session')->getFlashBag()->add('success', 'Your account has been created.');
        }

        // bind template variables
        return array(
            'form_signup' => $form_signup->createView(),
            'error' => null,
        );
    }*/


}
