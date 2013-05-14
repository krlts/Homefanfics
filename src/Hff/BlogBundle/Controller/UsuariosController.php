<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Usuarios;
use Hff\BlogBundle\Form\UsuariosType;

/**
 * Usuarios controller.
 *
 * @Route("/usuarios")
 */
class UsuariosController extends Controller
{
    /**
     * Lists all Usuarios entities.
     *
     * @Route("/", name="usuarios")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HffBlogBundle:Usuarios')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Usuarios entity.
     *
     * @Route("/", name="usuarios_create")
     * @Method("POST")
     * @Template("HffBlogBundle:Usuarios:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Usuarios();
        $form = $this->createForm(new UsuariosType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
              // Completar las propiedades que el usuario no rellena en el formulario
                $entity->setSalt(md5(time()));

                $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
                $passwordCodificado = $encoder->encodePassword(
                    $entity->getPassword(),
                    $entity->getSalt()
                );
                $entity->setPassword($passwordCodificado);

                // Guardar el nuevo usuario en la base de datos

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->setFlash('info',
                    '¡Enhorabuena! Te has registrado correctamente en Cupon'
                );
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuarios_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Usuarios entity.
     *
     * @Route("/new", name="usuarios_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Usuarios();
        $form   = $this->createForm(new UsuariosType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Usuarios entity.
     *
     * @Route("/{id}", name="usuarios_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Usuarios entity.
     *
     * @Route("/{id}/edit", name="usuarios_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

        $editForm = $this->createForm(new UsuariosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Usuarios entity.
     *
     * @Route("/{id}", name="usuarios_update")
     * @Method("PUT")
     * @Template("HffBlogBundle:Usuarios:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuarios entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsuariosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuarios_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Usuarios entity.
     *
     * @Route("/{id}", name="usuarios_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuarios entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuarios'));
    }

    /**
     * Creates a form to delete a Usuarios entity by id.
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
    
     public function loginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();

        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('HffBlogBundle:Usuarios:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        ));
    }
    
}
