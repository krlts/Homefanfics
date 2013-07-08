<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class BusquedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texto', 'text', array('attr' => 
            array('size' => '80', 'class' => 'input-xxlarge', 'placeholder' => 'Nombre y Apellido', 'title' => 'Nombre y Apellido')))
        ;
       
    }

    public function getName()
    {
        return 'frmBuscar';
    }
}

?>
