<?php

namespace Papillon\TasksBundle\Controller;

use Papillon\TasksBundle\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Papillon\TasksBundle\Form\TasksType;

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
     * @Template("PapillonTasksBundle:Task:task.html.twig")
     */
    public function taskAction()
    {
        $user = $this->get('security.context')->getToken()->getUser()->getId();

        //var_dump($this->get('security.context')->isGranted('ROLE_ADMIN'));
        $em = $this->getDoctrine()->getManager();
        $oTasks = $em->getRepository('PapillonTasksBundle:Tasks')->getTasksByUser($user);
        //$oTasks = $em->getRepository('PapillonTasksBundle:Tasks')->findAll();

        return $this->render('PapillonTasksBundle:Task:task.html.twig', array(
            'tasks' => $oTasks
        ));
    }


    /**
     * @Route("/tasks/new", name="new_task")
     * @Template("PapillonTasksBundle:Task:newTask.html.twig")
     */
    public function newAction(Request $request)
    {
        $tasks = new Tasks();
        $form = $this->createForm(new TasksType(), $tasks);
        $user = $this->get('security.context')->getToken()->getUser();

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $tasks->setAssignedBy($user);
            $tasks->setTimeSpent(0);

            $em->persist($tasks);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Task added.');
            return $this->redirect($this->generateUrl('tasks'));
        }
        return $this->render('PapillonTasksBundle:Task:new.html.twig', array(
            'entity' => $tasks,
            'form' => $form->createView(),
        ));
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
        $oTasks = $em->getRepository('PapillonTasksBundle:Tasks')->getTasksByUser($user);

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
     * @Template("PapillonTasksBundle:Task:alert.html.twig")
     */
    public function alertAction()
    {
        return array();
    }
}
