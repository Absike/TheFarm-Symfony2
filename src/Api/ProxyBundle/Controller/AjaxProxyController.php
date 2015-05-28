<?php

namespace Api\ProxyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Api\ProxyBundle\Libs\Curl;

class AjaxProxyController extends Controller
{


    /**
     * @Route("/ajax/proxy", name="_ajaxProxy", options={"expose"=true})
     * @Template()
     */
    public function proxyAction(Request $request)
    {
        // Forbid every request but jquery's XHR
        if ($request->isXmlHttpRequest()) {

            $restUrl = $request->get('restUrl');
            $method  = $request->get('method', 'get');

            if ( !$restUrl  || !$method || !in_array($method, array('GET', 'POST', 'DELETE'))){
                return new Response('', 404, array('Content-Type' => 'application/json'));
            }

            $url = 'http://' . $request->getHttpHost() . $restUrl;
            $result = curl::$method($url, $request->get('params', array()));

            $response = new Response($result);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }
    }
}