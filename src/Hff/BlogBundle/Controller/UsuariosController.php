<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hff\BlogBundle\Entity\Usuarios;
use Hff\BlogBundle\Form\UsuariosType;

/**
 * Usuarios controller.
 *
 * @Route("/usuario")
 */
class UsuariosController extends Controller
{
    /**
     * Lists all Usuarios entities.
     *
     * @Route("/", name="usuario")
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
     * @Route("/", name="usuario_crear")
     * @Method("POST")
     * @Template("HffBlogBundle:Usuarios:registrar.html.twig")
     */
    public function crearAction(Request $request)
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
                $direccionIp = $this->get('request')->getClientIp();
                $entity->setUltimaIp($direccionIp);
                
                $this->enviarEmailBienvenida($entity);

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->setFlash('info',
                    '¡Enhorabuena! Te has registrado correctamente en Homefanfics'
                );
            // Guardar el nuevo usuario en la base de datos
            $em->persist($entity);
            $em->flush();
            
            // Loguear al usuario automáticamente
                $token = new UsernamePasswordToken($entity, $entity->getPassword(), 'usuarios', $entity->getRoles());
                $this->container->get('security.context')->setToken($token);

            return $this->redirect($this->generateUrl('inicio', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Usuarios entity.
     *
     * @Route("/registrar", name="usuario_registrar")
     * @Method("GET")
     * @Template()
     */
    public function registrarAction()
    {
        $entity = new Usuarios();
        $form   = $this->createForm(new UsuariosType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    public function enviarEmailBienvenida(Usuarios $usuario)
    { 
        $mensaje = \Swift_Message::newInstance()
            ->setSubject('Nuestra más cordial Bienvenida a Homefanfics, '. $usuario->getUsuario())
            ->setFrom(array($this->container->getParameter('hff_blog.emails.no_reply') => 'Homefanfics'))
            ->setTo($usuario->getEmail())
                ->setContentType('text/html')
            ->setBody($this->renderView('HffBlogBundle:Usuarios:bienvenidaEmail.html.twig',array('usuario' => $usuario)));
        $this->get('mailer')->send($mensaje);

    }
    /**
     * Displays a form to create a new Usuarios entity.
     *
     * @Route("/nuevo", name="usuario_nuevo")
     * @Method("GET")
     * @Template()
     */
    public function nuevoAction()
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
     * @Route("/{id}", name="usuario_ver")
     * @Method("GET")
     * @Template()
     */
    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
        }

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllEscritosByUsuario($id);
        $comentarios = $em->getRepository('HffBlogBundle:Comentarios')->findPublicadosByEmisor($id);

        return array(
            'entity'      => $entity,
            'escritos' => $escritos,
            'comentarios' => $comentarios,
        );
    }

    /**
     * Displays a form to edit an existing Usuarios entity.
     *
     * @Route("/{id}/editar", name="usuario_editar")
     * @Method("GET")
     * @Template()
     */
    public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
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
     * Displays a form to edit an existing Usuarios entity.
     *
     * @Route("/{id}/editar", name="usuario_editar")
     * @Method("GET")
     * @Template()
     */
    public function miscomentariosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarioLogueado = $this->get('security.context')->getToken()->getUser();
        $idUsuario = $usuarioLogueado->getId();
        
        $usuario = $em->getRepository('HffBlogBundle:Usuarios')->find($idUsuario);

        if (!$usuario) {
            throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
            
        }
        $comentarios = $em->getRepository('HffBlogBundle:Comentarios')->findPublicadosByEmisor($idUsuario);

        return array(
            'usuario'      => $usuario,
            'comentarios' => $comentarios,
        );
    }
    
    /**
     * Finds and displays a preview of Escritos entity.
     *
     */
    public function mostrarMisEscritos($id)
    {
        $em = $this->getDoctrine()->getManager();

        $escritos = $em->getRepository('HffBlogBundle:Escritos')->findAllEscritosByUsuario($id);

        if (!$escritos) {
            throw $this->createNotFoundException('No se pudo encontrar algún Escrito');
        }   

        return array('escritos'  => $escritos,);
    }
    /**
     * Finds and displays a preview of Escritos entity.
     *
     */
    public function mostrarMisComentarios($id)
    {
        $em = $this->getDoctrine()->getManager();

        $comentarios = $em->getRepository('HffBlogBundle:Comentarios')->findAllByEmisor($id);

        if (!$comentarios) {
            throw $this->createNotFoundException('No se pudo encontrar algún Escrito');
        }   

        return array('comentarios'  => $comentarios,);
    }

    /**
     * Edits an existing Usuarios entity.
     *
     * @Route("/{id}", name="usuario_actualizar")
     * @Method("PUT")
     * @Template("HffBlogBundle:Usuarios:editar.html.twig")
     */
    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UsuariosType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_ver', array('id' => $id)));
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
     * @Route("/{id}", name="usuario_borrar")
     * @Method("DELETE")
     */
    public function borrarAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
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
       /* $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HffBlogBundle:Usuarios')->find($id);
            ;*/
            
            
/*
            if (!$entity) {
                throw $this->createNotFoundException('No se pudo encontrar el Usuario.');
            }

            $em->remove($entity);
            $em->flush();*/
            
        return $this->render('HffBlogBundle:Usuarios:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        ));
    }
    
}
