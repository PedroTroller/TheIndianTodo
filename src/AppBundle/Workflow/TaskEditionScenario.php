<?php

namespace AppBundle\Workflow;

use AppBundle\Workflow\Step\ConfigurableTaskStep;
use AppBundle\Workflow\Step\InitializeUpdateStep;
use AppBundle\Workflow\Step\UpdateStep;
use Sylius\Bundle\FlowBundle\Process\Builder\ProcessBuilderInterface;
use Sylius\Bundle\FlowBundle\Process\Scenario\ProcessScenarioInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class TaskEditionScenario extends ContainerAware implements ProcessScenarioInterface
{
    public function build(ProcessBuilderInterface $builder)
    {
        $builder
            ->add('initialize',     new InitializeUpdateStep())
            ->add('title',          new ConfigurableTaskStep('task_title'))
            ->add('description',    new ConfigurableTaskStep('task_description'))
            ->add('creator',        new ConfigurableTaskStep('task_creator'))
            ->add('persons_email',  new ConfigurableTaskStep('task_persons_email'))
            ->add('persons',        new ConfigurableTaskStep('task_persons'))
            ->add('finalize',       new UpdateStep())
            ->setRedirect('app_tasks_index')
        ;
    }
}
