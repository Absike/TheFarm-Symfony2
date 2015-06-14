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
        return $this->get('_query')->_query("PapillonTasksBundle:Tasks");
    }


} 