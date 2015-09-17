<?php

namespace AppBundle\Workflow\Step;

use AppBundle\Controller\Controller;
use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\ActionResult;
use Sylius\Bundle\FlowBundle\Process\Step\StepInterface;

abstract class AbstractControllerStep extends Controller implements StepInterface
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        return $this->complete();
    }

    public function isActive()
    {
        return true;
    }

    public function complete()
    {
        return new ActionResult();
    }

    public function proceed($nextStepName)
    {
        return new ActionResult($nextStepName);
    }
}
