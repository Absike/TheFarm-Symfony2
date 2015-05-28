<?php

namespace Papillon\TasksBundle\Controller;

use Papillon\TasksBundle\Entity\Projects;
use Papillon\TasksBundle\Form\ProjectsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProjectsController
 * @package Papillon\TasksBundle\Controller
 */
class ProjectsController extends Controller
{

    /**
     * @Route("/projects" , name="projects")
     * @Template("PapillonTasksBundle:Projects:index.html.twig")
     */
    public function projectsAction()
    {
        return array();
    }

    /**
     * @Route("/projects/new", name="new_project")
     * @Template("PapillonTasksBundle:Projects:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $project = new Projects();
        $form = $this->createForm(new ProjectsType(), $project);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Project added.');
            return $this->redirect($this->generateUrl('projects'));
        }

        return $this->render('PapillonTasksBundle:Projects:new.html.twig', array(
            'entity' => $project,
            'form' => $form->createView(),
        ));
    }

}
