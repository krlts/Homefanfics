<?php

namespace Hff\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
//use Sonata\AdminBundle\Datagrid\ShowMapper;

class UsuariosAdmin extends Admin {

    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('usuario', null, array('label' => 'Usuario'))
                ->add('nombreReal', null, array('label' => 'Nombre'))
                ->add('email')
                ->add('bloqueado')
                ->add('enviarMail')
                ->add('fechaRegistro')
                ->add('ultimaVisita', null, array('label' => 'Última Visita'))
                ->add('ultimaIP', null, array('label' => 'Última IP'))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('usuario')
                ->add('nombreReal')
                ->add('email')
                ->add('bloqueado')
                ->add('enviarMail')
                ->add('fechaRegistro')
                ->add('ultimaVisita')
        ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
                ->add('usuario')
                ->add('nombreReal')
                ->add('email')
                ->add('bloqueado')
                ->add('enviarMail')
                ->add('fechaRegistro')
                ->add('ultimaVisita')

        ;
    }

}

