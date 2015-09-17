<?php

namespace AppBundle\Workflow;

use AppBundle\Workflow\Step\ConfigurableTaskStep;
use AppBundle\Workflow\Step\FinalizeStep;
use Sylius\Bundle\FlowBundle\Process\Builder\ProcessBuilderInterface;
use Sylius\Bundle\FlowBundle\Process\Scenario\ProcessScenarioInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class TaskScenario extends ContainerAware implements ProcessScenarioInterface
{
    public function build(ProcessBuilderInterface $builder)
    {
        $builder
            ->add('title',          new ConfigurableTaskStep('task_title'))
            ->add('description',    new ConfigurableTaskStep('task_description'))
            ->add('creator',        new ConfigurableTaskStep('task_creator'))
            ->add('persons_email',  new ConfigurableTaskStep('task_persons_email'))
            ->add('persons',        new ConfigurableTaskStep('task_persons'))
            ->add('finalize',       new FinalizeStep())
            ->setRedirect('app_tasks_index')
        ;
    }
}
