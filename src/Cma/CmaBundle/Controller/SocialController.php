<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cma\CmaBundle\Entity\Social;
use Cma\CmaBundle\Form\SocialType;

/**
 * Social controller.
 *
 * @Route("/social")
 */
class SocialController extends Controller
{

    /**
     * Lists all Social entities.
     *
     * @Route("/", name="social")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmaBundle:Social')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Social entity.
     *
     * @Route("/", name="social_create")
     * @Method("POST")
     * @Template("CmaBundle:Social:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Social();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('social_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Social entity.
     *
     * @param Social $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Social $entity)
    {
        $form = $this->createForm(new SocialType(), $entity, array(
            'action' => $this->generateUrl('social_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Social entity.
     *
     * @Route("/new", name="social_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Social();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Social entity.
     *
     * @Route("/{id}", name="social_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Social')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Social entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Social entity.
     *
     * @Route("/{id}/edit", name="social_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Social')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Social entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Social entity.
    *
    * @param Social $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Social $entity)
    {
        $form = $this->createForm(new SocialType(), $entity, array(
            'action' => $this->generateUrl('social_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Social entity.
     *
     * @Route("/{id}", name="social_update")
     * @Method("PUT")
     * @Template("CmaBundle:Social:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Social')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Social entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('social_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Social entity.
     *
     * @Route("/{id}", name="social_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CmaBundle:Social')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Social entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('social'));
    }

    /**
     * Creates a form to delete a Social entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('social_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
