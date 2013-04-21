<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Hff\BlogBundle\Entity\Autores;

class AutoresController extends Controller
{
    public function crearAction() 
    {
        $autor = new Autores();
        $autor->setNombre('Charles Chaplin');
        $em = $this->getDoctrine()->getManager();
        $em->persist($autor);
        $em->flush();
        return new Response('Id de Autor '.$autor->getId().' de '.$autor->getNombre().' creado.');

    }
    public function borrarAction() 
    {
         
    }
    public function editarAction() 
    {
         
    }
    public function listarAction() 
    {
         $em = $this->getDoctrine()->getManager();
         $autores = $em->getRepository('HffBlogBundle:Autores')->findAll();
         return $this->render('HffBlogBundle:Autores:listar.html.twig', array('autores' => $autores));
         
    }
}


