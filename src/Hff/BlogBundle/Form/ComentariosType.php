<?php

namespace Hff\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComentariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mensaje', 'ckeditor', array('label' => 'Comentario',
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

