<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text', array('attr' => 
            array('size' => '80', 'placeholder' => 'Nombre y Apellido', 'title' => 'Nombre y Apellido')));
        $builder->add('email', 'email', array('attr' => 
            array('size' => '80','placeholder' => 'Tu correo electrónico', 'title' => 'Tu correo electrónico')));
        $builder->add('asunto', 'text', array('attr' => 
            array('size' => '80','placeholder' => 'Asunto por el que nos contactas', 'title' => 'Asunto por el que nos contactas')));
        $builder->add('mensaje', 'textarea', array('attr' => 
            array('rows' => '5','cols' => '80', 'placeholder' => 'Mensaje, comentario, crítica, consejo o sugerencia que deseas enviar', 'title' => 'Mensaje, comentario, crítica, consejo o sugerencia que deseas enviar')));
    }

    public function getName()
    {
        return 'frmContacto';
    }
}
?>
