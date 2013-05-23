<?php

namespace Hff\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CitasAdmin extends Admin{
    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('id', null, array('label' => 'ID'))
                ->add('texto', null, array('label' => 'Cita'))
                ->add('autor')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('texto', null, array('label' => 'Cita', 'attr' => array('placeholder' =>'Ingresa la Cita')))
                ->add('autor')
        ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
               ->add('texto', null, array('label' => 'Cita', 'attr' => array('placeholder' =>'Ingresa la Cita')))
                ->add('autor')
        ;
    }

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('texto', null, array('label' => 'Cita', 'attr' => array('placeholder' =>'Ingresa la Cita')))
                ->add('autor')
        ;
    }
}

?>
