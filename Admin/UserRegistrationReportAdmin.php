<?php

namespace San\ReportBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserRegistrationReportAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    // public function getTemplate($name)
    // {
    //     if ($name == 'edit') {
    //         return 'SanEmailBundle:Admin/CRUD:email_edit.html.twig';
    //     }

    //     return parent::getTemplate($name);
    // }

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
        ;
    }
}
