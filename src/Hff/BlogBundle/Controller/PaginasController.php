<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    
}


