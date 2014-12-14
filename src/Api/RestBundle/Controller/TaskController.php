<?php

namespace Api\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController extends Controller {


    /**
     * @Rest\View
     */
    public function allAction()
    {
        $oTasks = $this->getDoctrine()->getRepository("PapillonTasksBundle:Tasks")->findAll();

        if(!$oTasks)
        {
            throw $this->createNotFoundException('No task found.');
        }

        return $oTasks;
    }


} 