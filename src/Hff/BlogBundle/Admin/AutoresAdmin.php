<?php

namespace Hff\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AutoresAdmin extends Admin{
    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('id', null, array('label' => 'ID'))
                ->add('nombre', null, array('label' => 'Autor'))
                ->add('citas')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('nombre', null, array('label' => 'Autor','attr' => array('placeholder' =>'Ingresa el nombre del autor')))
                ->add('citas')
            ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
               ->add('nombre', null, array('label' => 'Autor','attr' => array('placeholder' =>'Ingresa el nombre del autor')))
               //->add('citas') 
            ;
    }

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('nombre', null, array('label' => 'Autor','attr' => array('placeholder' =>'Ingresa el nombre del autor')))
                ->add('citas')
            ;
    }
}

?>

