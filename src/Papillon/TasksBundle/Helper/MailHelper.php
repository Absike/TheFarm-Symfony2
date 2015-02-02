<?php

namespace Papillon\TasksBundle\Helper;

/**
 * Mailer Helper
 *
 * @package Mailer
 * @version 0.1
 * @copyright Copyright 2015 (C) Hassan Absike. - All Rights Reserved
 */
class MailHelper
{

    /**
    * admin email address
    */
    const EMAIL_FROM = 'support@papillonv2.com';

    /**
     * service container
     *
     * @var object
     */
    protected $service;
 
    /**
     * init service
     *
     * @param object $service
     * @return $this
     */
    public function __construct($service) {
        $this->service = $service;
 
        return $this;
    }
 
    /**
     * Send email
     *
     * @param string $to
     * @param twig $view
     * @param string $subject
     */
    public function sendEmail($to, $view, $subject = 'Email from Papillon')
    {

        if(!isset($view) || !isset($to)){
            throw new \Exception('There is something wrong');
        } 

        //we create a new instance of the Swift_Message class  
        $message = \Swift_Message::newInstance()->setContentType('text/html')
        ->setSubject($subject)
        ->setFrom(self::EMAIL_FROM)
        ->setTo($to)
        ->setBody($view);
 
        // then we send the message.
        $send = $this->service->get('mailer')->send($message);

        if($send){
            return true;
        }else{
            return false;
        }

    }
}

