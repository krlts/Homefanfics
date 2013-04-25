<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Hff\BlogBundle\Entity\Citas;

class CitasController extends Controller
{
    public function crearAction() 
    {
       
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
         $citas = $em->getRepository('HffBlogBundle:Citas')->findAll();
         return $this->render('HffBlogBundle:Citas:listar.html.twig', array('citas' => $citas));
         
    }
}