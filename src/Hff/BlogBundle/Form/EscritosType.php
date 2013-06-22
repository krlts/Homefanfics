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
            ->add('titulo','text',array('label'=>'Título','attr'=>array('class' => 'input-block-level','size' => '80', 'placeholder' => 'Ingresa el Título', 'title' => 'Ingresa el Título','maxlength' => '255')))
            ->add('categoria', 'entity', array(
                'class' => 'Hff\\BlogBundle\\Entity\\Categorias',
                'empty_value' => '-Seleccionar Categoría-',
                'query_builder' => function(EntityRepository $repositorio) {
                    return $repositorio->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                },
            ))
            //->add('usuario')//,'text',array('value'=>$username))           
            ->add('tags','text',array('label'=>'Etiquetas', 'required' => false,'attr'=>array('class' => 'input-block-level','size' => '80',' placeholder' => 'Etiquetas, Tags', 'title' => 'Etiquetas, Tags','maxlength' => '255')))
            //->add('intro','ckeditor',array('label'=>'Introducción','attr' => array('class' => 'ckeditor')))
          //  ->add('contenido','ckeditor',array('attr' => array('class' => 'ckeditor')))
                    ->add('intro', 'ckeditor', array(
    'config' => array(
        'toolbar' => array(
            array(
                'name'  => 'clipboard',
                'items' => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
            ),
            array(
                'name'  => 'editing',
                'items' => array('Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'),
            ),
            array(
                'name'  => 'document',
                'items' => array('Source'),
            ),
            '/',
            array(
                'name'  => 'basicstyles',
                'items' => array('Bold', 'Italic', 'Underline', 'Strike', '-','Subscript', 'Superscript', '-', 'RemoveFormat'),
            ),
            array(
                'name'  => 'paragraph',
                'items' => array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv' ),
            ),
            array(
                'name'  => 'insert',
                'items' => array('Image','Table','HorizontalRule','Smiley','SpecialChar'),
            ),
            '/',
            array(
                'name'  => 'styles',
                'items' => array('Font','FontSize','Styles','Format'),
            ),
            array(
                'name'  => 'colors',
                'items' => array('TextColor','BGColor'),
            ),
            array(
                'name'  => 'links',
                'items' => array('Link','Unlink','Anchor'),
            ),
            array(
                'name'  => 'tools',
                'items' => array('Maximize', 'ShowBlocks'),
            ),
        ),
    )))
            ->add('contenido', 'ckeditor', array(
    'config' => array(
        'toolbar' => array(
            array(
                'name'  => 'clipboard',
                'items' => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
            ),
            array(
                'name'  => 'editing',
                'items' => array('Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'),
            ),
            array(
                'name'  => 'document',
                'items' => array('Source'),
            ),
            '/',
            array(
                'name'  => 'basicstyles',
                'items' => array('Bold', 'Italic', 'Underline', 'Strike', '-','Subscript', 'Superscript', '-', 'RemoveFormat'),
            ),
            array(
                'name'  => 'paragraph',
                'items' => array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv' ),
            ),
            array(
                'name'  => 'insert',
                'items' => array('Image','Table','HorizontalRule','Smiley','SpecialChar'),
            ),
            '/',
            array(
                'name'  => 'styles',
                'items' => array('Font','FontSize','Styles','Format'),
            ),
            array(
                'name'  => 'colors',
                'items' => array('TextColor','BGColor'),
            ),
            array(
                'name'  => 'links',
                'items' => array('Link','Unlink','Anchor'),
            ),
            array(
                'name'  => 'tools',
                'items' => array('Maximize', 'ShowBlocks'),
            ),
        ),
    )))
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
        return 'frmEscritos';
    }
}

?>
