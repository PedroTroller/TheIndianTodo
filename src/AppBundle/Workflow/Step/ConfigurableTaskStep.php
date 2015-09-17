<?php

namespace AppBundle\Workflow\Step;

use Sylius\Bundle\FlowBundle\Process\Context\ProcessContextInterface;
use Sylius\Bundle\FlowBundle\Process\Step\AbstractControllerStep;

class ConfigurableTaskStep extends AbstractControllerStep
{
    private $formName;

    public function __construct($formName)
    {
        $this->formName = $formName;
    }

    public function displayAction(ProcessContextInterface $context)
    {
        $form = $this->createForm($this->formName, $context->getStorage()->get('task'), [
            'action' => $this->generateUrl('sylius_flow_forward', [
                'scenarioAlias' => $context->getProcess()->getScenarioAlias(),
                'stepName'      => $this->getName(),
            ])
        ]);

        return $this->render('AppBundle:Tasks/Step:base.html.twig', [
            'context' => $context,
            'form'    => $form->createView()
        ]);
    }

    public function forwardAction(ProcessContextInterface $context)
    {
        $form = $this->createForm($this->formName, $context->getStorage()->get('task'), [
            'action' => $this->generateUrl('sylius_flow_forward', [
                'scenarioAlias' => $context->getProcess()->getScenarioAlias(),
                'stepName'      => $this->getName(),
            ])
        ]);

        $form->handleRequest($context->getRequest());

        if (true === $form->isValid()) {
            $context->getStorage()->set('task', $form->getData());

            return $this->complete();
        }

        return $this->render('AppBundle:Tasks/Step:base.html.twig', [
            'context' => $context,
            'form'    => $form->createView()
        ]);
    }
}
