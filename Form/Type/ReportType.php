<?php

namespace San\ReportBundle\Form\Type;

use San\ReportBundle\ReportEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'choices' => ReportEvents::getReports()
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\ReportBundle\Document\Report'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'report';
    }
}
