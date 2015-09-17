<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskCreatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('owner', 'person', [
                'required' => false,
            ])
            ->add('creator', 'person', [
                'required' => false,
            ])
        ;
    }

    public function getParent()
    {
        return 'task';
    }

    public function getName()
    {
        return 'task_creator';
    }
}
