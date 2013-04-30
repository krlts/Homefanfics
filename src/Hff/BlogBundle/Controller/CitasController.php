<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Citas;
use Hff\BlogBundle\Form\CitasType;

/**
 * Citas controller.
 *
 * @Route("/citas")
 */
class CitasController extends Controller
{
    /**
     * Lists all Citas entities.
     *
     * @Route("/", name="citas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HffBlogBundle:Citas')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Citas entity.
     *
     * @Route("/", name="citas_create")
     * @Method("POST")
     * @Template("HffBlogBundle:Citas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Citas();
        $form = $this->createForm(new CitasType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('citas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Citas entity.
     *
     * @Route("/new", name="citas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Citas();
        $form   = $this->createForm(new CitasType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Citas entity.
     *
     * @Route("/{id}", name="citas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Citas entity.
     *
     * @Route("/{id}/edit", name="citas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
        }

        $editForm = $this->createForm(new CitasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Citas entity.
     *
     * @Route("/{id}", name="citas_update")
     * @Method("PUT")
     * @Template("HffBlogBundle:Citas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Citas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Citas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CitasType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('citas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Citas entity.
     *
     * @Route("/{id}", name="citas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Citas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Citas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('citas'));
    }

    /**
     * Creates a form to delete a Citas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
