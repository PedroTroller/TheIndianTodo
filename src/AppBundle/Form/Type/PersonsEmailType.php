<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransformer\PersonsToEmailsTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonsEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addViewTransformer(new PersonsToEmailsTransformer())
        ;
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'persons_email';
    }
}
