<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutoresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
        ;
       
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hff\BlogBundle\Entity\Autores'
        ));
    }

    public function getName()
    {
        return 'autores';
    }
/*public function getName()
    {
        return 'hff_blogbundle_autorestype';
    }*/

}
