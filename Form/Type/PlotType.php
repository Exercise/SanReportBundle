<?php

namespace San\ReportBundle\Form\Type;

use San\ReportBundle\Form\Type\FilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlotType extends AbstractType
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
        return 'plot_reports';
    }
}
