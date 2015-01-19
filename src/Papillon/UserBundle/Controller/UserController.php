<?php

namespace Papillon\UserBundle\Controller;

use Papillon\UserBundle\Entity\User;
use Papillon\UserBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @Route("/secured")
 */
class UserController extends Controller
{

    /**
     * @Route("/login", name="login")
     * @Template("PapillonUserBundle:User:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $form_signup = $this->createForm(new UserType());

        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }


        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
            'form_signup' => $form_signup->createView(),
        );

    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }


    /**
     * @Route("/signup", name="signup")
     * @Template("PapillonUserBundle:User:login.html.twig")
     */
    public function signUpAction(Request $request)
    {
        $user = new User();
        $form_signup = $this->createForm(new UserType(),$user);

        if ($request->isMethod('POST') && $form_signup->submit($request)->isValid()) {

                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $user->encodePassword($encoder);

                //TODO: Temporary add role to user
                $user->addGroup($this->getDoctrine()->getRepository('PapillonUserBundle:Group')->findOneByName('User'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Your account has been created.');
        }

        // bind template variables
        return array(
            'form_signup' => $form_signup->createView(),
            'error' => null,
        );
    }


}
