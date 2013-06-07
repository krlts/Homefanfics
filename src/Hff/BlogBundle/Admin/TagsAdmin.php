<?php

namespace Hff\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TagsAdmin  extends Admin{

    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('id', null, array('label' => 'ID'))
                ->add('nombre', null, array('label' => 'Tag'))
                ->add('slug', null, array('label' => 'Path'))
                ->add('fechaCreacion', null, array('label' => 'Creado', 'attr' => array('placeholder' =>'Fecha Creación')))
                ->add('fechaModificacion', null, array('label' => 'Modificado', 'attr' => array('placeholder' =>'Fecha Modificación')))
                ->add('habilitado', null, array('label' => 'Habilitado', 'attr' => array('placeholder' =>'Se encuentra habilitado')))
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('nombre', null, array('label' => 'Tag'))
                ->add('slug', null, array('label' => 'Path'))
                ->add('fechaCreacion', null, array('label' => 'Creado', 'attr' => array('placeholder' =>'Fecha Creación')))
                ->add('fechaModificacion', null, array('label' => 'Modificado', 'attr' => array('placeholder' =>'Fecha Modificación')))
                ->add('habilitado', null, array('label' => 'Habilitado', 'attr' => array('placeholder' =>'Se encuentra habilitado')))
            ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
                ->add('nombre', null, array('label' => 'Tag'))
                ->add('slug', null, array('label' => 'Path'))
                ->add('fechaCreacion', null, array('label' => 'Creado', 'attr' => array('placeholder' =>'Fecha Creación')))
                ->add('fechaModificacion', null, array('label' => 'Modificado', 'attr' => array('placeholder' =>'Fecha Modificación')))
                ->add('habilitado', null, array('label' => 'Habilitado', 'attr' => array('placeholder' =>'Se encuentra habilitado')))
            ;
    }

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('nombre', null, array('label' => 'Tag'))
                ->add('slug', null, array('label' => 'Path'))
                ->add('fechaCreacion', null, array('label' => 'Creado', 'attr' => array('placeholder' =>'Fecha Creación')))
                ->add('fechaModificacion', null, array('label' => 'Modificado', 'attr' => array('placeholder' =>'Fecha Modificación')))
                ->add('habilitado', null, array('label' => 'Habilitado', 'attr' => array('placeholder' =>'Se encuentra habilitado')))
            ;
    }
}

?>
