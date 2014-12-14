<?php

namespace Api\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller {


    /**
     * @Rest\View
     */
    public function allAction()
    {
        $oTasks = $this->getDoctrine()->getRepository("PapillonTasksBundle:Projects")->findAll();

        if(!$oTasks)
        {
            throw $this->createNotFoundException('No projects found.');
        }

        return $oTasks;
    }


} 