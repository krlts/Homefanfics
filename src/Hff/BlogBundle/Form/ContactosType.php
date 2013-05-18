<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('email', 'email');
        $builder->add('asunto');
        $builder->add('mensaje', 'textarea');
    }

    public function getName()
    {
        return 'contacto';
    }
}
?>
