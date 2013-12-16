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
            ->add('from', 'date', array(
                'widget' => 'single_text',
            ))
            ->add('to', 'date', array(
                'widget' => 'single_text',
            ))
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
