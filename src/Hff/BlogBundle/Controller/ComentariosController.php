<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Comentarios;
use Hff\BlogBundle\Form\ComentariosType;

class ComentariosController extends Controller{
    /**
     * Lista todos los Comentarios 
     *
     * @Route("/", name="comentario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HffBlogBundle:Comentarios')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Crear una nueva Entity Comentarios
     *
     * @Route("/", name="comentario_crear")
     * @Method("POST")
     * @Template("HffBlogBundle:Comentarios:nuevo.html.twig")
     */
    public function crearAction(Request $request)
    {
        $entity  = new Comentarios();
        $form = $this->createForm(new ComentariosType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_ver', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Despliega el formulario para crear una nueva entity Comentarios.
     *
     * @Route("/nuevo", name="comentario_nuevo")
     * @Method("GET")
     * @Template()
     */
    public function nuevoAction()
    {
        $entity = new Comentarios();
        $form   = $this->createForm(new ComentariosType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Encontrar y desplegar una entity Comentarios.
     *
     * @Route("/{id}", name="comentario_ver")
     * @Method("GET")
     * @Template()
     */
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Comentarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Comentario');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Desplegar un formulario para editar una entity Comentarios existente
     *
     * @Route("/{id}/editar", name="comentario_editar")
     * @Method("GET")
     * @Template()
     */
    public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Comentarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Comentario');
        }

        $editForm = $this->createForm(new ComentariosType(), $entity);
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
     * @Route("/{id}", name="comentario_actualizar")
     * @Method("PUT")
     * @Template("HffBlogBundle:Autores:editar.html.twig")
     */
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Comentarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Comentario');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ComentariosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comentario_ver', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Borrar una entity Comentarios
     *
     * @Route("/{id}", name="comentario_borrar")
     * @Method("DELETE")
     */
    public function borrarAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Comentarios')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se pudo encontrar el ComentarioUnable to find Autores entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comentario'));
    }

    /**
     * Crear un formulario para borrar una entidad Comentarios por id.
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

?>
