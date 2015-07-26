<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cma\CmaBundle\Entity\Meta;
use Cma\CmaBundle\Form\MetaType;

/**
 * Meta controller.
 * 
 */
class MetaController extends Controller {

    public function indexAction() {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmaBundle:Meta')->findAll();

        return $this->render('CmaBundle:Default:Meta/index.html.twig', array(
                    'username' => $user, 'entities' => $entities,
        ));
    }

    public function homeAction() {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        //recuperer les atributs de l'objet Etablissement
        $em = $this->getDoctrine()->getManager();
        //verifier si l'id de utilisateur est le meme dans la table utilisateur 
        $query = $em->createQuery(
                        'SELECT M
                 FROM CmaBundle:Meta M 
                 WHERE M.id = 1'
                )->setMaxResults(1);

        $metadata = $query->getSingleResult();

        return $this->render('CmaBundle:Default:Meta/home.html.twig', array('username' => $user, 'data' => $metadata));
    }

    /**
     * 
     * methode to add new Meta.
     *
     */
    public function addAction(Request $request) {
// afficher le module de  telechargement de document
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

//recuperer les atributs de l'objet Etablissement
        $em = $this->getDoctrine()->getManager();
//verifier si l'id de utilisateur est le meme dans la table utilisateur 
        $query = $em->createQuery(
                'SELECT M
                 FROM CmaBundle:Meta M 
                 WHERE M.id =1'
        );

        $metadata = $query->getResult();

        if (!empty($metadata)) {
            return $this->redirect($this->generateUrl('meta_index'));
        } else {
// recuperer les coordonnées des tables existantes
            $meta = new Meta();
            $Metaform = new MetaType();

            $form = $this->createForm($Metaform, $meta);

//verifier si le formulaire est validée
            if ($this->getRequest()->getMethod() === 'POST') {

//$form->bindRequest($this->getRequest());
                $form->handleRequest($request);

                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($meta);
                    $em->flush();
                    return $this->redirect($this->generateUrl('meta_index'));
                }
            }
            return $this->render('CmaBundle:Default:Meta/add.html.twig', array('form' => $form->createView(), 'username' => $user));
        }
    }

    /**
     * Modifier les elements de l'entitÃ© Establishement 
     * 
     * @return type
     */
    public function editAction(Request $request, $id) {

        /* recuperer les atributs de l'objet User */
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());

        /* recuperer les atributs de l'objet Etablissement */
        $em = $this->getDoctrine()->getManager();

        /* verifier si l'id de utilisateur est le meme dans la table utilisateur */
        $query = $em->createQuery(
                        'SELECT M
                 FROM CmaBundle:Meta M '
                )->setMaxResults(1);


        $meta = $query->getSingleResult();

        /* find formulaire de modification */
        $form = $this->createForm(new MetaType(), $meta);
        $form->handleRequest($request);

        /* verifier si le  formulaire est valide */
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meta);
            $em->flush();
            return $this->redirect($this->generateUrl('meta_index'));
        }
        return $this->render('CmaBundle:Default:Meta/edit.html.twig', array('form' => $form->createView(), 'meta' => $meta, 'username' => $user));
    }

}
