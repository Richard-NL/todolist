<?php

namespace Rsh\Bundle\TodolistBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', 'textarea')
            ->add('priority', 'entity', array(
                'class' => 'Rsh\Bundle\TodolistBundle\Entity\Priority',
                'empty_value' => 'Choose a Priority',
            ))
            ->add('status', 'entity', array(
                'class' => 'Rsh\Bundle\TodolistBundle\Entity\Status',
                'empty_value' => 'Choose a Status',
            ))
            ->add('endDate', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date')
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rsh\Bundle\TodolistBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rsh_bundle_todolistbundle_task';
    }
}
