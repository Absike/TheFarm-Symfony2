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
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }

    /**
     * @param $to
     * @param $view
     * @param string $subject
     * @return bool
     * @throws \Exception
     */
    public function sendEmail($to, $view, $subject = 'Email from Papillon')
    {

        if(!isset($view) || !isset($to)){
            throw new \Exception('There is something wrong');
        } 

        //we create a new instance of the Swift_Message class  
        $message = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(self::EMAIL_FROM)
        ->setTo($to)
        ->setBody($view,'text,html');
 
        // then we send the message.
        $send = $this->mailer->send($message);

        if($send){
            return true;
        }else{
            return false;
        }

    }
}

