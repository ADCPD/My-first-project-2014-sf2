<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 
use Cma\CmaBundle\Entity\Service;
use Cma\CmaBundle\Form\ServiceType;

/**
 * Service controller.
 *
 *  
 */
class ServiceController extends Controller
{
 
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository('CmaBundle:Service')->findAll();
        
        return $this->render('CmaBundle:Default:Service/index.html.twig', array('service' => $services,'username'=>$user ));  
    }
    
     public function homeAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository('CmaBundle:Service')->findAll();
        
        return $this->render('CmaBundle:Default:Service/home.html.twig', array('service' => $services,'username'=>$user ));  
    }
    
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        
        $services = new Service();
        
        $form = $this->createForm(new ServiceType(), $services);
        
        if ($this->getRequest()->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $services->uploadServcePicture();
                $em->persist($services);
                $em->flush();
                return $this->redirect($this->generateUrl('Service_index'));
            }
        }
 
        return $this->render('CmaBundle:Default:Service/add.html.twig', array('service' => $services,'username'=>$user,'form' => $form->createView() ));  
    } 
    
    public function editAction(Request $request, $id) {

        $user = $this->getUser();
              
        /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $service = $em->getRepository('CmaBundle:Service')->find($id);
        
        /* find formulaire de modification */
        $form = $this->createForm(new ServiceType(), $service);
        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             $service->uploadServcePicture();
            $em->persist($service);
            $em->flush();
            return $this->redirect($this->generateUrl('Service_index'));
        }
        return $this->render('CmaBundle:Default:Service/edit.html.twig', array('form' => $form->createView(), 'service' => $service, 'username' => $user));
    }
}
