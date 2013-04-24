<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Autores;
use Hff\BlogBundle\Form\AutoresType;

/**
 * Autores controller.
 *
 * @Route("/autores")
 */
class AutoresController extends Controller
{
    /**
     * Lists all Autores entities.
     *
     * @Route("/", name="autores")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HffBlogBundle:Autores')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Autores entity.
     *
     * @Route("/", name="autores_create")
     * @Method("POST")
     * @Template("HffBlogBundle:Autores:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Autores();
        $form = $this->createForm(new AutoresType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('autores_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Autores entity.
     *
     * @Route("/new", name="autores_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Autores();
        $form   = $this->createForm(new AutoresType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Autores entity.
     *
     * @Route("/{id}", name="autores_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Autores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Autores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Autores entity.
     *
     * @Route("/{id}/edit", name="autores_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Autores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Autores entity.');
        }

        $editForm = $this->createForm(new AutoresType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Autores entity.
     *
     * @Route("/{id}", name="autores_update")
     * @Method("PUT")
     * @Template("HffBlogBundle:Autores:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Autores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Autores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AutoresType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('autores_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Autores entity.
     *
     * @Route("/{id}", name="autores_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Autores')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Autores entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('autores'));
    }

    /**
     * Creates a form to delete a Autores entity by id.
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
    public function __toString() {  
     return $this->nombre; 
    }
}
