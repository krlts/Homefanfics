<?php
namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class EscritosType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$username = $this->get('security.context')->getToken()->getUser();

        $builder
           // ->add('usuario','text',array('value'=>$usuario))
            ->add('titulo','text',array('label'=>'Título','attr'=>array('size' => '80', 'placeholder' => 'Ingresa el Título', 'title' => 'Ingresa el Título','maxlength' => '255')))
            ->add('categoria', 'entity', array(
                'class' => 'Hff\\BlogBundle\\Entity\\Categorias',
                'empty_value' => '-Seleccionar Categoría-',
                'query_builder' => function(EntityRepository $repositorio) {
                    return $repositorio->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                },
            ))
            //->add('usuario')//,'text',array('value'=>$username))           
            ->add('tags','text',array('label'=>'Etiquetas','attr'=>array('size' => '80', 'placeholder' => 'Etiquetas, Tags', 'title' => 'Etiquetas, Tags','maxlength' => '255')))
            ->add('intro','textarea',array('label'=>'Introducción','attr' => 
            array('rows' => '3','cols' => '160','placeholder' => 'Escribe acá si deseas que tu escrito tenga una introducción', 'title' => 'Escribe acá si deseas que tu escrito tenga una introducción')))
            ->add('contenido','textarea',array('attr' => array('rows' => '8','cols' => '160')))
            ->add('publicado','checkbox',array('required'  => false, 'attr'=>array('checked'=>true)))
                        
                        
     
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hff\BlogBundle\Entity\Escritos'
        ));
    }

    public function getName()
    {
        return 'escritos';
    }
}

?>
