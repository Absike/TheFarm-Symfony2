<?php

namespace Papillon\UserBundle\Controller;

use Papillon\UserBundle\Entity\User;
use Papillon\UserBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
class UserController extends Controller
{

    /**
     * @Route("/users",name="users")
     * @Template("PapillonUserBundle:User:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/signup", name="signup")
     * @Template("PapillonUserBundle:User:signup.html.twig")
     */
    public function signupAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if ($request->isMethod('POST') && $form->submit($request)->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->encodePassword($encoder);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('signin'));
        }

        return array('form' => $form->createView());
    }


    /**
     * @Route("/signin", name="signin")
     * @Template("PapillonUserBundle:User:signin.html.twig")
     */
    public function signinAction(Request $request)
    {
        $session = $request->getSession();

        if ($username = $session->get(SecurityContext::LAST_USERNAME)) {
            $session->remove(SecurityContext::LAST_USERNAME);
        }
        if ($error = $session->get(SecurityContext::AUTHENTICATION_ERROR)) {
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $username,
            'error' => $error,
        );

    }

    /**
     * @Route("/bootstrap" , name="bootstrap")
     * @Template("PapillonUserBundle:User:bootstrap.html.twig")
     */
    public function bootstrapAction()
    {
        return array();
    }


    /**
     * @Route("/forms" , name="forms")
     * @Template("PapillonUserBundle:User:forms.html.twig")
     */
    public function formsAction()
    {
        return array();
    }
}
