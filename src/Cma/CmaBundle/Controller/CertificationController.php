<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cma\CmaBundle\Entity\Certificat;
use Cma\CmaBundle\Form\CertificatType;
/**
 * Slide controller.
 *
 * @Route("/slide")
 */
class CertificationController extends Controller {
    /*
     * DASBORD VIEW 
     * TABLE DE DONNEES 
     */

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $certficat = $em->getRepository('CmaBundle:Certificat')->findAll();
        return $this->render('CmaBundle:Default:Certificat/index.html.twig', array('certficat' => $certficat, 'username' => $user));
    }

    public function homeAction() {
        $user = $this->getUser();

        //recuperer les atributs de l'objet Etablissement
        $em = $this->getDoctrine()->getManager();
        //verifier si l'id de utilisateur est le meme dans la table utilisateur 
        $query = $em->createQuery(
                 'SELECT C
                 FROM CmaBundle:Certificat C '
                );

        $entities = $query->getResult();
        
        return $this->render('CmaBundle:Default:Certificat/home.html.twig', array('username' => $user, 'entities' => $entities));
    }

    public function addAction(Request $request) {
        $user = $this->getUser();

        $certificat = new Certificat();

        $form = $this->createForm(new CertificatType(), $certificat);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $certificat->uploadCertificatPicture();
                $em->persist($certificat);
                $em->flush();
                return $this->redirect($this->generateUrl('certificat_index'));
            }
        }

        return $this->render('CmaBundle:Default:Certificat/add.html.twig', array('certificat' => $certificat, 'username' => $user, 'form' => $form->createView()));
    }

    public function editAction(Request $request, $id) {
        $user = $this->getUser();

        /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $certificat = $em->getRepository('CmaBundle:Certificat')->find($id);

        /* find formulaire de modification */
        $form = $this->createForm(new CertificatType, $certificat);

        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $certificat->uploadCertificatPicture();
            $em->persist($certificat);
            $em->flush();
            return $this->redirect($this->generateUrl('certificat_index'));
        }


        return $this->render('CmaBundle:Default:Certificat/edit.html.twig', array('certificat' => $certificat, 'username' => $user, 'form' => $form->createView()));
    }

    /**
     * Deletes a Slide entity.
     *
     *  
     * @Method("DELETE")
     */
    public function dropAction($id) {
        $query = $this->get('doctrine')->getEntityManager()
                ->createQuery(
                'DELETE FROM CmaBundle:Certificat C
                        WHERE C.id = :id');
        $query->setParameters(array(
            'id' => $id
        ));

        $query->execute();

        return $this->redirect($this->generateUrl('certificat_index'));
    }

}
