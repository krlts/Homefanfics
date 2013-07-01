<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Categorias;
use Hff\BlogBundle\Form\CategoriasType;

/**
 * Categorias controller.
 *
 * @Route("/categoria")
 */
class CategoriasController extends Controller
{
    /**
     * Lists all Categorias entities.
     *
     * @Route("/", name="categoria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HffBlogBundle:Categorias')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Categorias entity.
     *
     * @Route("/", name="categoria_crear")
     * @Method("POST")
     * @Template("HffBlogBundle:Categorias:nueva.html.twig")
     */
    public function crearAction(Request $request)
    {
        $entity  = new Categorias();
        $form = $this->createForm(new CategoriasType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_ver', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Categorias entity.
     *
     * @Route("/nueva", name="categoria_nueva")
     * @Method("GET")
     * @Template()
     */
    public function nuevaAction()
    {
        $entity = new Categorias();
        $form   = $this->createForm(new CategoriasType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Categorias entity.
     *
     * @Route("/{id}", name="categoria_ver")
     * @Method("GET")
     * @Template()
     */
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('HffBlogBundle:Categorias')->find($id);
        
        if (!$categoria) {
            throw $this->createNotFoundException('No se encontró la Categoría');
        }
        
        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllByCategoria($id);

        /*if (!$escritos) {
            throw $this->createNotFoundException('No se encontraron Escritos en la Categoría');
        }*/


        return array(
            'escritos'      => $escritos,
            'categoria' => $categoria,
        );
    }
    

    /**
     * Rescata todas las Categorias de la base de datos
     *
     * @Route("/", name="categoria_lista")
     * @Method("GET")
     * @Template()
     */
    public function listaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('HffBlogBundle:Categorias')->findAll();

        return $this->render('HffBlogBundle:Categorias:lista.html.twig', array('categorias' => $categorias));
    }

    /**
     * Edits an existing Categorias entity.
     *
     * @Route("/{id}", name="categoria_actualizar")
     * @Method("PUT")
     * @Template("HffBlogBundle:Categorias:editar.html.twig")
     */
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Categorias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar la Categoria');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CategoriasType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_ver', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Categorias entity.
     *
     * @Route("/{id}", name="categoria_borrar")
     * @Method("DELETE")
     */
    public function borrarAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Categorias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se pudo encontrar la Categoria');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoria'));
    }

    /**
     * Creates a form to delete a Categorias entity by id.
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
    
    
    /*public function getCategorias()
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('HffBlogBundle:Categorias')
            ->findAllOrderedByName();
        return $categorias;
    }*/
}
