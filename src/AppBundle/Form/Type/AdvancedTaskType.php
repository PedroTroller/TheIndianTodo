<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvancedTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('owner', 'person', [
                'required' => false,
            ])
            ->add('creator', 'person', [
                'required' => false,
            ])
            ->add('persons', 'collection', [
                'type'         => 'person',
                'allow_add'    => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function getParent()
    {
        return 'task';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('validation_groups', 'advanced');
    }

    public function getName()
    {
        return 'advanced_task';
    }
}
