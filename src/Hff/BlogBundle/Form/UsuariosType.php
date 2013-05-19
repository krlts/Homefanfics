<?php
namespace Hff\BlogBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuariosType extends AbstractType{
    //put your code here
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('usuario','text',array('attr'=>array('size' => '60', 'placeholder' => 'Usuario o Alias', 'title' => 'Usuario o Alias')))
                ->add('password', 'repeated', 
                array('type' => 'password'))
                ->add('email', 'email',array('attr'=>array('size' => '60', 'placeholder' => 'Tu correo electrónico', 'title' => 'Tu correo electrónico')))
                ->add('nombreReal','text', array('attr'=>array('size' => '60', 'placeholder' => 'Nombres y Apellidos', 'title' => 'Nombres y Apellidos')))
                ->add("acepto",
                "checkbox", array(
                    "mapped" => false,
                ));
       
    }
    public function getName()
    {
        return 'usuario_form';
    }
}
?>
