<?php

namespace Papillon\UserBundle\Controller;

use Papillon\UserBundle\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Papillon\UserBundle\Form\TasksType;

class TaskController extends Controller
{

    /**
     * @Route("/tasks", name="tasks")
     * @Template("PapillonUserBundle:Task:task.html.twig")
     */
    public function taskAction()
    {
        $em = $this->getDoctrine()->getManager();
        $oTasks = $em->getRepository('PapillonUserBundle:Tasks')->getTasksByUser(1);

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
     * @Route("/alert", name="alert")
     * @Template("PapillonUserBundle:Task:alert.html.twig")
     */
    public function alertAction()
    {
        return array();
    }
}
