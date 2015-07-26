<?php

namespace Cma\CmaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cma\CmaBundle\Entity\Apropos;
use Cma\CmaBundle\Form\AproposType;

/**
 * Apropos controller.
 *
 * @Route("/apropos")
 */
class AproposController extends Controller
{

    /**
     * Lists all Apropos entities.
     *
     * @Route("/", name="apropos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CmaBundle:Apropos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Apropos entity.
     *
     * @Route("/", name="apropos_create")
     * @Method("POST")
     * @Template("CmaBundle:Apropos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Apropos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('apropos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Apropos entity.
     *
     * @param Apropos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Apropos $entity)
    {
        $form = $this->createForm(new AproposType(), $entity, array(
            'action' => $this->generateUrl('apropos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Apropos entity.
     *
     * @Route("/new", name="apropos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Apropos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Apropos entity.
     *
     * @Route("/{id}", name="apropos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Apropos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apropos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Apropos entity.
     *
     * @Route("/{id}/edit", name="apropos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Apropos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apropos entity.');
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
    * Creates a form to edit a Apropos entity.
    *
    * @param Apropos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Apropos $entity)
    {
        $form = $this->createForm(new AproposType(), $entity, array(
            'action' => $this->generateUrl('apropos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Apropos entity.
     *
     * @Route("/{id}", name="apropos_update")
     * @Method("PUT")
     * @Template("CmaBundle:Apropos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CmaBundle:Apropos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Apropos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('apropos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Apropos entity.
     *
     * @Route("/{id}", name="apropos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CmaBundle:Apropos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Apropos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('apropos'));
    }

    /**
     * Creates a form to delete a Apropos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('apropos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
