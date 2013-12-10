<?php

namespace San\ReportBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlotReportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'datetime')
            ->add('to', 'datetime')
            ->add('reports', 'collection', array(
                'type'         => 'report',
                'allow_add'    => true,
                'allow_delete' => true,
            ))
            ->add('submit', 'submit')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'plot_report';
    }
}
