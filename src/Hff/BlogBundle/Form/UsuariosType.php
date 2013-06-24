<?php
namespace Hff\BlogBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/* 
 *  la clase UsuariosType hereda de AbstractType, que actúa de formulario base
 */

class UsuariosType extends AbstractType{
    /*
     * buildForm construye el formulario para Registrar usuario
     * @param Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     * @return void 
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Agrega los campos que se ingresaran en el formulario
        $builder->add('usuario','text',array('attr'=>array('size' => '60', 'placeholder' => 'Usuario o Alias', 'title' => 'Usuario o Alias','maxlength' => '40')))
                ->add('password', 'repeated', 
                array('type' => 'password', 
                    'invalid_message' => 'Las dos contraseñas deben ser iguales',
                    'first_options'=> array('attr'=> array('size' => '60', 'placeholder' => 'Ingresa una Contraseña', 'title' => 'Ingresa una Contraseña','maxlength' => '40')),
                    'second_options'=> array('attr'=> array('size' => '60', 'placeholder' => 'Repita la Contraseña', 'title' => 'Repita la Contraseña', 'maxlength' => '40'))))
                ->add('email', 'email',array('attr'=>array('size' => '60', 'placeholder' => 'Tu correo electrónico', 'title' => 'Tu correo electrónico','maxlength' => '100')))
                ->add('nombreReal','text', array('attr'=>array('size' => '60', 'placeholder' => 'Nombres y Apellidos', 'title' => 'Nombres y Apellidos','maxlength' => '100')))
                ->add("acepto",         
                "checkbox", array(
                    'invalid_message' => 'Debes leer y aceptar los términos y conciciones',
                    "mapped" => false,
                ));
       
    }
    /*
     * getName retorna el nombre del formulario
     * @param void
     * @return string $nombreFormulario
     */
    public function getName()
    {
        return 'frmUsuario';
    }
}
?>
