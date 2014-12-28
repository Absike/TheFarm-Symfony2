<?php

namespace Api\ProxyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;

use Api\ProxyBundle\Libs\Curl;

class AjaxProxyController extends Controller
{


    /**
     * @Route("/ajax/proxy", name="_ajaxProxy")
     * @Template()
     */
    public function proxyAction(Request $request)
    {

        // Forbid every request but jquery's XHR
        if ($request->isXmlHttpRequest()) {

            $restUrl = $request->get('restUrl');
            $method = $request->get('method');
            $params = $request->get('params', array());

            if ($restUrl == null || $method == null || !in_array($method, array('GET', 'POST', 'DELETE'))
            ) {
                return new Response('', 404, array('Content-Type' => 'application/json'));
            }

            $url = 'http://' . $request->getHttpHost() . $restUrl;
            if ($method == 'POST') {
                $result = curl::post($url, $params);
            }

            if ($method == 'GET') {
                $result = curl::get($url, $params);
            }

            if ($result) {
                return new Response($result, 200, array('Content-Type' => 'application/json'));
            } else {
                return new Response('', 404, array('Content-Type' => 'application/json'));
            }

        }
    }
}