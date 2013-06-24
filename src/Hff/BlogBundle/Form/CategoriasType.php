<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion', 'textarea', array('attr' => 
            array('rows' => '3','cols' => '80', 'placeholder' => 'Ingresa la descripción de la Categoría', 'title' => 'Ingresa la descripción de la Categoría')))
            ->add('imagen')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hff\BlogBundle\Entity\Categorias'
        ));
    }

    public function getName()
    {
        return 'frmCategoria';
    }
}
