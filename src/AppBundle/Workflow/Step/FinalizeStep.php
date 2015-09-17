<?php

namespace AppBundle\Workflow\Step;

use AppBundle\Workflow\Step\AbstractControllerStep;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;

class FinalizeStep extends AbstractControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        return $this->render('AppBundle:Tasks/Step:finalize.html.twig', [
            'context' => $context,
            'task'    => $context->getStorage()->get('task')
        ]);
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $task = $context->getStorage()->get('task');

        $this->persist($task);
        $this->flush();

        return $this->complete();
    }
}
