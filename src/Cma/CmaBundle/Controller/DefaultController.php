<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cma\CmaBundle\CmaBundle\Form\MailType;

class DefaultController extends Controller
{
public function indexAction()
{
//recuperer les atributs de l'objet Etablissement
$em = $this->getDoctrine()->getManager();
//verifier si l'id de utilisateur est le meme dans la table utilisateur 
$Contactdata = $em->createQuery(
'SELECT C 
                 FROM CmaBundle:Contact C 
                 WHERE C.id = 1'
)->setMaxResults(1);

$Metadata = $em->createQuery(
'SELECT M 
                 FROM CmaBundle:Meta M 
                 WHERE M.id = 1'
)->setMaxResults(1);



$Slidedata = $em->createQuery(
'SELECT S 
                 FROM CmaBundle:Slide S 
                 Where S.id=1'
)->setMaxResults(1);

$service = $em->getRepository('CmaBundle:Service')->findAll();

/*
 * recuprer que 3 images pour le slide
 */
$query1 = $em->createQuery(
'SELECT S
                 FROM CmaBundle:Slide S 
                 Where S.id=1'
);
$query2 = $em->createQuery(
'SELECT S
                 FROM CmaBundle:Slide S 
                 Where S.id=2'
);
$query3 = $em->createQuery(
'SELECT S
                 FROM CmaBundle:Slide S 
                 Where S.id=3'
);
/*
 *  recuperer tout les images pour la section  moyens techniques
 */
$images = $em->getRepository('CmaBundle:Image')->findAll();

$slide1 = $query1->getResult();
$slide2 = $query2->getResult();
$slide3 = $query3->getResult();

$contact = $Contactdata->getSingleResult();
$meta = $Metadata->getSingleResult();

$slide = $Slidedata->getSingleResult();


return $this->render('CmaBundle:Default:index.html.twig',
 array('data' => $meta, 'contact' => $contact, 'service' => $service,
 'slide' => $slide, 'slide1' => $slide1, 'slide2' => $slide2, 'slide3' => $slide3,
 'images' => $images));

}

public function dashbordAction()
{
$userManager = $this->container->get('fos_user.user_manager');
$user = $userManager->findUserByUsername($this->container->get('security.context')
->getToken()
->getUser());

return $this->render('CmaBundle:Administrator:index.html.twig', array('username' => $user));
}

/* @Route("/contact", _name = "contact")
* @Template()
*/
public function contactAction(Request $request)
{
$form = $this->createForm(new MailType());

if ($request->isMethod('POST')) {
$form->bind($request);

if ($form->isValid()) {
$message = \Swift_Message::newInstance()
->setSubject($form->get('subject')->getData())
->setFrom($form->get('email')->getData())
->setTo('contact@cmanalyses.com')
->setBody(
$this->renderView(
'LCWebsiteBundle:Default:Mail/contact.html.twig',
 array(
'ip' => $request->getClientIp(),
 'name' => $form->get('name')->getData(),
 'message' => $form->get('message')->getData()
)
)
);

$this->get('mailer')->send($message);

$request->getSession()->getFlashBag()->add('success', 'Your email has been sent! Thanks!');

return $this->redirect($this->generateUrl('contact'));
}
}

return array(
'form' => $form->createView()
);
}
}

