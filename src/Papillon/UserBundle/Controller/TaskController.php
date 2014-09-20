<?php

namespace Papillon\UserBundle\Controller;

use Papillon\UserBundle\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Papillon\UserBundle\Form\TasksType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class TaskController extends Controller
{

    /**
     * @Route("/tasks", name="tasks")
     * @Template("PapillonUserBundle:Task:task.html.twig")
     */
    public function taskAction()
    {
        $user = $this->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $oTasks = $em->getRepository('PapillonUserBundle:Tasks')->getTasksByUser($user);

        return $this->render('PapillonUserBundle:Task:task.html.twig', array(
            'tasks' => $oTasks
        ));
    }


    /**
     * @Route("/new_task", name="new_task")
     * @Template("PapillonUserBundle:Task:newTask.html.twig")
     */
    public function newTaskAction(Request $request)
    {

        $tasks = new Tasks();
        $form = $this->createForm(new TasksType(), $tasks);

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $tasks->setTimeSpent(10);

            $em->persist($tasks);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Task added.');
            return $this->redirect($this->generateUrl('tasks'));

        }


      return $this->render('PapillonUserBundle:Task:newTask.html.twig', array('form' => $form->createView()));
    }


    /**
     * List of tasks
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {

        $user = $this->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $oTasks = $em->getRepository('PapillonUserBundle:Tasks')->getTasksByUser($user);

        //initialisation du serializer
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($serializer->serialize($oTasks, 'json'));

        return $response;

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
