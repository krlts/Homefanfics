<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaginasController extends Controller
{
    public function indexAction()
    {
       //return $this->render('HffBlogBundle:Paginas:index.html.twig', array('name' => $name));
       return $this->render('HffBlogBundle:Paginas:index.html.twig');
        
    }
    
}


