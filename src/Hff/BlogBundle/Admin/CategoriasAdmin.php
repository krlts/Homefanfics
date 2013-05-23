<?php

namespace Hff\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoriasAdmin extends Admin {

    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('nombre', null, array('label' => 'Categoria'))
                ->add('descripcion')
                ->add('imagen')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('nombre')
                ->add('descripcion')
                ->add('imagen')
        ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
                ->add('nombre')
                ->add('descripcion')
                ->add('imagen')
        ;
    }

    protected function configureShowField(ShowMapper $showMapper) {
        $showMapper
                ->add('nombre')
                ->add('descripcion')
                ->add('imagen')
        ;
    }

}

?>
