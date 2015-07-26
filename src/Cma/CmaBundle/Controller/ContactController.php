<?php

namespace Cma\CmaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\HttpFoundation\Request;
use Cma\CmaBundle\Entity\Contact;


/**
 * Contact controller.
 */
class ContactController extends Controller {

    public function homeAction() {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        //recuperer les atributs de l'objet Etablissement
        $em = $this->getDoctrine()->getManager();
        //verifier si l'id de utilisateur est le meme dans la table utilisateur 
        $query = $em->createQuery(
                 'SELECT C
                 FROM CmaBundle:Contact C 
                 WHERE C.id = 1'
                )->setMaxResults(1);

        $contact = $query->getSingleResult();
        
        return $this->render('CmaBundle:Default:Contact/home.html.twig', array('username' => $user, 'contact' => $contact));
    }
    
    
    public function indexAction() {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmaBundle:Contact')->findAll();

        //return array('entities' => $entities,);
        return $this->render('CmaBundle:Default:Contact/index.html.twig', array('username' => $user, 'entities' => $entities,));
    }

    /**
     * 
     * methode to add new contact.
     *
     */
    
    public function addAction(Request $request) {
        // afficher le module de  telechargement de document
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        // recuperer les coordonnées des tables existantes
        $Contact = new Contact();
        $contactform = new \Cma\CmaBundle\Form\ContactType();
        
        $form = $this->createForm($contactform, $Contact);

        //verifier si le formulaire est validée
        if ($this->getRequest()->getMethod() === 'POST') {

            $form->bindRequest($this->getRequest());
            
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($Contact);
                $em->flush();
                return $this->redirect($this->generateUrl('contact_index'));
            }
        }
        return $this->render('CmaBundle:Default:Contact/edit.html.twig', array('form' => $form->createView(), 'username' => $user));
    }
    
    /**
     * Modifier les elements de l'entitÃ© Establishement 
     * 
     * @return type
     */
    Public function editAction(Request $request, $id) {
        
        /* recuperer les atributs de l'objet User */
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());
         
                /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $query = $em->createQuery(
                 'SELECT E
                 FROM CmaBundle:Contact E ' 
                )->setMaxResults(1);
        

        $contact = $query->getSingleResult();

        /* find formulaire de modification */
        $form = $this->createForm(new \Cma\CmaBundle\Form\ContactType(), $contact);
        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirect($this->generateUrl('contact_index'));
        }
        return $this->render('CmaBundle:Default:Contact/edit.html.twig', array('form' => $form->createView(), 'username' => $user));
    }


}
