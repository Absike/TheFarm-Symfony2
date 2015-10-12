<?php

namespace Api\RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller {


    /**
     * @Rest\View
     */
    public function allAction()
    {
        $data = $this->get('_query')->_query("PapillonTasksBundle:Customers");

        $aData = array();
        foreach($data as $item){

            array_push($aData , array(
                $item->getId(),
                $item->getName() ,
                $item->getAdresse(),
                $item->getPhone()
            ));
        }

        $_aData['aaData'] = $aData;
        return $_aData;
    }


} 