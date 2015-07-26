<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cma\CmaBundle\Entity\Sendmail;
use Cma\CmaBundle\Form\sendMailType;

/**
 * Sendmail controller.
 *
 * 
 */
class SendmailController extends Controller {
    /*
     * Sendmail form
     */

    public function indexAction( ) {         
        return $this->render('CmaBundle:Default:Contact/sendmail.html.twig');
    }
    
    public function redirectionAction (){
     
        return $this->render('CmaBundle:Default:Contact/sendmail.html.twig');
    }
    
    public function sendMailAction(){
        
        $request = $this->getRequest();
        if ($request->getMethod() == "POST"){
            $Subject = $resquest->get("subject");
            $Email = $resquest->get("email");
            $message = $request->get("message");
            
            $mailer = $this->containet->get('mailer');
            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
                    ->setUsername('*****') //on met ici  notre adresse mail
                    ->setPassword('*****'); // & ici  son mot de passe
            $mailer = \Swift_Message::newInstance($transport);
            $message= \Swift_Message::newInstance('test')
                    ->setSubject($Subject)
                    ->setFrom($Email)
                    ->setTo('votremailici@gmail.com') // j'utilise cette adresse pour envoyer des @
                    ->setBody($message);
            $this->get('mailer')->send($message);
                    
        }
        return $this->render('CmaBundle:Default:Contact/sendmail.html.twig');
    }

}
