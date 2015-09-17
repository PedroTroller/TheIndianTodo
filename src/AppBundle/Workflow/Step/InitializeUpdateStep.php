<?php

namespace AppBundle\Workflow\Step;

use AppBundle\Workflow\Step\AbstractControllerStep;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;

class InitializeUpdateStep extends AbstractControllerStep
{
    public function displayAction(ProcessContextInterface $context)
    {
        $id   = $context->getRequest()->query->get('task');
        $task = $this->getRepository('AppBundle:Task')->find($id);

        $context->getStorage()->set('task', $task);

        return $this->complete();
    }

    public function forwardAction(ProcessContextInterface $context)
    {
    }
}
