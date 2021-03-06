<?php

namespace San\ReportBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ReportAdmin extends Admin
{
    /**
     * @return array
     */
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
            ->remove('update')
            ->remove('batch')
            ->add('data', null, array(), array('_format' => 'json'))
        ;
    }
}
