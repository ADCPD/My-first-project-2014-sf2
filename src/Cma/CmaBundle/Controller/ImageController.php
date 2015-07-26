<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cma\CmaBundle\Entity\Image;
use Cma\CmaBundle\Form\ImageType;

/**
 * Slide controller.
 *
 * @Route("/slide")
 */
class ImageController extends Controller {
    /*
     * DASBORD VIEW 
     * TABLE DE DONNEES 
     */

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('CmaBundle:Image')->findAll();
        return $this->render('CmaBundle:Default:MoyenTechnique/index.html.twig', array('image' => $images, 'username' => $user));
    }

    public function homeAction() {
        $user = $this->getUser();
  
        $repository = $this->getDoctrine()
                ->getRepository('Cmabundle:Image');
        $images = $repository->findAll();

        return $this->render('CmaBundle:Default:MoyenTechnique/home.html.twig', array('username' => $user, 'images' => $images));
    }

    public function addAction(Request $request) {
        $user = $this->getUser();

        $images = new Image();

        $form = $this->createForm(new ImageType(), $images);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $images->uploadEnvironnementPicture();
                $em->persist($images);
                $em->flush();
                return $this->redirect($this->generateUrl('image_index'));
            }
        }

        return $this->render('CmaBundle:Default:MoyenTechnique/add.html.twig', array('images' => $images, 'username' => $user, 'form' => $form->createView()));
    }

    public function editAction(Request $request, $id) {
        $user = $this->getUser();

        /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $images = $em->getRepository('CmaBundle:Image')->find($id);

        /* find formulaire de modification */
        $form = $this->createForm(new ImageType(), $images);

        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $images->uploadEnvironnementPicture();
            $em->persist($images);
            $em->flush();
            return $this->redirect($this->generateUrl('image_index'));
        }


        return $this->render('CmaBundle:Default:MoyenTechnique/edit.html.twig', array('images' => $images, 'username' => $user, 'form' => $form->createView()));
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
                'DELETE FROM CmaBundle:Image I
                        WHERE I.id = :id');
        $query->setParameters(array(
            'id' => $id
        ));

        $query->execute();

        return $this->redirect($this->generateUrl('image_index'));
    }

}
