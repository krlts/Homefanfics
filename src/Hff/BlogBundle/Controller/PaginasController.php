<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hff\BlogBundle\Entity\Contactos;
use Hff\BlogBundle\Form\ContactosType;

class PaginasController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('HffBlogBundle:Categorias')
            ->findAllOrderedByName();
        
       //return $this->render('HffBlogBundle:Paginas:index.html.twig', array('name' => $name));
       //return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
       return $this->render('HffBlogBundle:Paginas:index.html.twig',  array('categorias' => $categorias));
        
    }
    
    public function contactoAction()
{
    $contacto = new Contactos();
    $form = $this->createForm(new ContactosType(), $contacto);

    $request = $this->getRequest();
    if ($request->getMethod() == 'POST') {
        //$form->bindRequest($request);
        $form->bind($request);
        if ($form->isValid()) {
     

            $mensaje = \Swift_Message::newInstance()
            ->setSubject('Contacto Hff')
            ->setFrom('enquiries@symblog.co.uk')
            ->setTo($this->container->getParameter('hff_blog.emails.contacto'))
            ->setBody($this->renderView('HffBlogBundle:Paginas:contactoEmail.html.twig', array('contacto' => $contacto)));
        $this->get('mailer')->send($mensaje);

        $this->get('session')->setFlash('blogger-notice', 'Su mensaje fue enviado. Gracias por contactar a Homefanfics');
            // Redirige - Esto es importante para prevenir que el usuario
            // reenvíe el formulario si actualiza la página
            return $this->redirect($this->generateUrl('HffBlogBundle_contacto'));
        }
    }

    return $this->render('HffBlogBundle:Paginas:contacto.html.twig', array(
        'form' => $form->createView()
    ));
}
    
}


