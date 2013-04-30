<?php
namespace Hff\BlogBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuariosType extends AbstractType{
    //put your code here
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('usuario')
                ->add('password', 'password')
                ->add('nombreReal')
                ->add('email', 'email')
                ->add("acepto_los_terminos_y_condiciones",
                "checkbox", array(
                    "property_path" => false,
                ));
       
    }
    public function getName()
    {
        return 'usuario_form';
    }
}
?>
