<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cma\CmaBundle\Entity\Slide;
use Cma\CmaBundle\Form\SlideType;

/**
 * Slide controller.
 *
 * @Route("/slide")
 */
class SlideController extends Controller {

    /**
     * Lists all Slide entities.
     *
     *  
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $slides = $em->getRepository('CmaBundle:Slide')->findAll();
        return $this->render('CmaBundle:Default:Slide/index.html.twig', array('slide' => $slides, 'username' => $user));
    }

    public function homeAction() {
        $user = $this->getUser();

//         $em = $this->getDoctrine()->getManager();
//         $slides = $em->getRepository('CmaBundle:Slide')->findAll();
        //recuperer les atributs de l'objet Etablissement
        $em = $this->getDoctrine()->getManager();
        //verifier si l'id de utilisateur est le meme dans la table utilisateur 
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

        $slide1 = $query1->getResult();
        $slide2 = $query2->getResult();
        $slide3 = $query3->getResult();

        return $this->render('CmaBundle:Default:Slide/home.html.twig', array('slide1' => $slide1, 'slide2' => $slide2, 'slide3' => $slide3, 'username' => $user,));
    }

    public function addAction(Request $request) {
        $user = $this->getUser();

        $slides = new Slide();

        $form = $this->createForm(new SlideType(), $slides);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $slides->uploadSlidePicture();
                $em->persist($slides);
                $em->flush();
                return $this->redirect($this->generateUrl('slider_index'));
            }
        }

        return $this->render('CmaBundle:Default:Slide/add.html.twig', array('slide' => $slides, 'username' => $user, 'form' => $form->createView()));
    }

    public function editAction(Request $request, $id) {
        $user = $this->getUser();

        /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $slide = $em->getRepository('CmaBundle:Slide')->find($id);

        /* find formulaire de modification */
        $form = $this->createForm(new SlideType(), $slide);
        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $slide->uploadSlidePicture();
            $em->persist($slide);
            $em->flush();
            return $this->redirect($this->generateUrl('slider_index'));
        }


        return $this->render('CmaBundle:Default:Slide/edit.html.twig', array('slide' => $slide, 'username' => $user, 'form' => $form->createView()));
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
                'DELETE FROM CmaBundle:Slide S
                        WHERE S.id = :id');
        $query->setParameters(array(
            'id' => $id
        ));

        $query->execute();

        return $this->redirect($this->generateUrl('slider_index'));
    }
}