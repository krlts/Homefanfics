<?php
namespace Hff\BlogBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuariosType extends AbstractType{
    //put your code here
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('usuario')
                ->add('password', 'repeated', 
                array('type' => 'password'))
                ->add('email', 'email')
                ->add('nombreReal')
                ->add("acepto",
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
