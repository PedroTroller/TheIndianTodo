<?php

namespace AppBundle\Workflow\Step;

use AppBundle\Workflow\Step\AbstractControllerStep;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;

class UpdateStep extends AbstractControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $task = $context->getStorage()->get('task');

        $task = $this->merge($task);
        $this->flush();

        return $this->complete();
    }

    public function forwardAction(ProcessContextInterface $context)
    {
    }
}
