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
            $escrito = $em->getRepository('HffBlogBundle:Escritos')->findOneById($entity->getEscrito());
            $escrito->setTotalComentarios($escrito->getTotalComentarios()+1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('escrito_ver', array('id' => $entity->getEscrito())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Despliega el formulario para crear una nueva entity Comentarios.
     *
     * @Route("/{id}", name="comentario_nuevo")
     * @Method("GET")
     * @Template()
     */
    public function nuevoAction($id)
    {     
        $entity = new Comentarios();
        $entity->setEscrito($id);
        
        $usuarioLogueado = $this->get('security.context')->getToken()->getUser();
        $entity->setEmisor($usuarioLogueado->getId());
        $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

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
        $emisor = $em->getRepository('HffBlogBundle:Usuarios')->findOneById($entity->getEmisor());
        

        return array(
            'entity'      => $entity,
            'emisor'      => $emisor,
        );
    }
    /**
     * Encontrar y desplegar una entity Comentarios.
     *
     * @Route("/{id}", name="comentario_resumen")
     * @Method("GET")
     * @Template()
     */
     public function resumenAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $comentario = $em->getRepository('HffBlogBundle:Comentarios')->find($id);
        if (!$comentario) {
            throw $this->createNotFoundException('El Usuario no ha hecho comentarios');
        }
        $escrito = $em->getRepository('HffBlogBundle:Escritos')->findOneById($comentario->getEscrito());
        //$escrito = $comentario['escrito'];
        return array(
            'comentario' => $comentario,
            'escrito' => $escrito,
        );
    }
    
    /**
     * Encontrar y desplegar una entity Comentarios.
     *
     * @Route("/{id}", name="comentario_resumen2")
     * @Method("GET")
     * @Template()
     */
     public function resumen2Action($idEscrito)
    {
        $em = $this->getDoctrine()->getManager();
        
        $escrito = $em->getRepository('HffBlogBundle:Escritos')->find($idEscrito);
        
        if (!$escrito) {
           throw $this->createNotFoundException('No se encontró el escrito');
        }
        $otrosComentarios = $em->getRepository('HffBlogBundle:Comentarios')->findPublicados($idEscrito);
        //$escrito = $comentario['escrito'];
        return array(
            //'escrito' => $escrito,
            'otrosComentarios' => $otrosComentarios,
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

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Autores entity.
     *
     * @Route("/{id}", name="comentario_actualizar")
     * @Method("PUT")
     * @Template("HffBlogBundle:Comentarios:editar.html.twig")
     */
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Comentarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Comentario');
        }

        $editForm = $this->createForm(new ComentariosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('escrito_ver', array('id' => $entity->getEscrito())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
}

?>
