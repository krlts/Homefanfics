<?php

namespace Hff\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hff\BlogBundle\Entity\Usuarios;
use Hff\BlogBundle\Form\UsuariosType; 

class UsuariosController extends Controller
{
    public function crearAction() 
    {
        $usuario = new Usuarios();
        $form = $this->createForm(new UsuariosType(), $usuario);
        return $this->render('HffBlogBundle:Usuarios:crear.html.twig', array(
        'form' => $form->createView(),));
    }
    public function borrarAction() 
    {
         
    }
    public function editarAction() 
    {
         
    }
    public function listarAction() 
    {
         
    }
}


