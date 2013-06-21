<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mensaje','textarea',array('label'=>'Comentario','attr' => array('class' => 'ckeditor', 'rows' => '8','cols' => '80')))
        ;
       
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hff\BlogBundle\Entity\Comentarios'
        ));
    }

    public function getName()
    {
        return 'frmComentarios';
    }
}

