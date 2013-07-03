<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Hff\BlogBundle\Entity\Escritos;
use Hff\BlogBundle\Form\EscritosType;

/**
 * Escritos controller.
 *
 * @Route("/escritos")
 */
class EscritosController extends Controller{
    /**
     * Lists all Escritos entities.
     *
     * @Route("/", name="escrito")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllRecientes();

        return array('escritos' => $escritos);
    }
    /**
     * Lists all Escritos entities.
     *
     * @Route("/mascomentados", name="escrito_mascomentados")
     * @Method("GET")
     * @Template()
     */
    public function mascomentadosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllMasComentados();
        return array('escritos' => $escritos);
    }
    /**
     * Lists all Escritos entities.
     *
     * @Route("/masvistos", name="escrito_masvistos")
     * @Method("GET")
     * @Template()
     */
    public function masvistosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllMasVistos();
        return array('escritos' => $escritos);
    }
    
    /**
     * Lists all Escritos entities.
     *
     * @Route("/az", name="escrito_az")
     * @Method("GET")
     * @Template()
     */
    public function azAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllTitulos();
        return array('escritos' => $escritos);
    }
    
    /**
     * Crear una nueva Entidad Escritos.
     *
     * @Route("/", name="escrito_crear")
     * @Method("POST")
     * @Template("HffBlogBundle:Escritos:nuevo.html.twig")
     */
    public function crearAction(Request $request)
    {
        $entity  = new Escritos();
        $em = $this->getDoctrine()->getManager();
        
        $usuarioLogueado = $this->get('security.context')->getToken()->getUser();
        $entity->setUsuario($usuarioLogueado);
        
        $form = $this->createForm(new EscritosType(), $entity);
        
        $form->bind($request);
        
        $entity->setCategoria($form["categoria"]->getData());

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('escrito_ver', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Escritos entity.
     *
     * @Route("/nuevo", name="escrito_nuevo")
     * @Method("GET")
     * @Template()
     */
    public function nuevoAction()
    {
        $entity = new Escritos();
        $form   = $this->createForm(new EscritosType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Escritos entity.
     *
     * @Route("/{id}", name="escrito_ver")
     * @Method("GET")
     * @Template()
     */
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Escritos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Escrito');
        }
        $entity->setTotalVistas( $entity->getTotalVistas() +1 ) ;
        $comentarios = $this->mostrarComentarios($id);
        $siguiente = $em->getRepository('HffBlogBundle:Escritos')->findSiguiente($id);
        $anterior = $em->getRepository('HffBlogBundle:Escritos')->findAnterior($id);
        $siguienteDelAutor = $em->getRepository('HffBlogBundle:Escritos')->findSiguienteDelAutor($id);
        $anteriorDelAutor = $em->getRepository('HffBlogBundle:Escritos')->findAnteriorDelAutor($id);
        $siguienteDeLaCategoria = $em->getRepository('HffBlogBundle:Escritos')->findSiguienteDeLaCategoria($id);
        $anteriorDeLaCategoria = $em->getRepository('HffBlogBundle:Escritos')->findAnteriorDeLaCategoria($id);
        if (!$siguiente)
        {
            $siguiente = array($entity);
        }
        if (!$siguienteDelAutor )
        {
            $siguienteDelAutor = array($entity);
        }
        if (!$anteriorDelAutor )
        {
            $anteriorDelAutor = array($entity);
        }
        if (!$siguienteDeLaCategoria )
        {
            $siguienteDeLaCategoria = array($entity);
        }
        if (!$anteriorDeLaCategoria )
        {
            $anteriorDeLaCategoria = array($entity);
        }
        if (!$anterior)
        {
            $anterior = array($entity);
        }
        
        $em->persist($entity);
        $em->flush();
        

        return array(
            'entity'      => $entity,
            'comentarios' => $comentarios,
            'siguiente'   => $siguiente,
            'siguienteDelAutor' => $siguienteDelAutor,
            'anteriorDelAutor' => $anteriorDelAutor,
            'siguienteDeLaCategoria' => $siguienteDeLaCategoria,
            'anteriorDeLaCategoria' => $anteriorDeLaCategoria,
            'anterior'    => $anterior,
        );
    }
    
    /**
     * Finds and displays a preview of Escritos entity.
     *
     * @Route("/{id}", name="escrito_preview1")
     * @Method("GET")
     * @Template()
     */
    public function preview1Action($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Escritos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Escrito');
        }   

        return array('entity'  => $entity,);
    }
 
    /**
     * Displays a form to edit an existing Escritos entity.
     *
     * @Route("/{id}/editar", name="escrito_editar")
     * @Method("GET")
     * @Template()
     */
    public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Escritos')->find($id);
        $categorias = $em->getRepository('HffBlogBundle:Categorias')
            ->findAllOrderedByName();

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Escrito');
        }

        $editForm = $this->createForm(new EscritosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'categorias' => $categorias,
        );
    }

    /**
     * Edits an existing Categorias entity.
     *
     * @Route("/{id}", name="escrito_actualizar")
     * @Method("PUT")
     * @Template("HffBlogBundle:Escritos:editar.html.twig")
     */
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Escritos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Escrito');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EscritosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('escrito_ver', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Escritos entity.
     *
     * @Route("/{id}", name="escrito_borrar")
     * @Method("DELETE")
     */
    public function borrarAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Escritos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se pudo encontrar el Escrito');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('escrito'));
    }

    public function mostrarComentarios($escritoId)
    {
        $em = $this->getDoctrine()->getManager();

        $comentarios = $em->getRepository('HffBlogBundle:Comentarios')->findPublicados($escritoId);
    
        return $comentarios;
    }
    /**
     * Creates a form to delete a Escritos entity by id.
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
