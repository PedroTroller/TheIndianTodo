<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\PropertyAccess\PropertyAccess;

abstract class Controller extends BaseController
{
    protected function getRepository($class)
    {
        return $this
            ->getDoctrine()
            ->getRepository($class)
        ;

        return $this
            ->getDoctrine()
            ->getManagerForClass($class)
            ->getRepository($class)
        ;
    }

    protected function persist($object)
    {
        $this
            ->getDoctrine()
            ->getManager()
            ->persist($object)
        ;

        return $this;
    }

    protected function remove($object)
    {
        $this
            ->getDoctrine()
            ->getManager()
            ->remove($object)
        ;

        return $this;
    }

    protected function merge($object)
    {
        return $this
            ->getDoctrine()
            ->getManager()
            ->merge($object)
        ;
    }

    protected function flush($object = null)
    {
        $this
            ->getDoctrine()
            ->getManager()
            ->flush($object)
        ;

        return $this;
    }

    protected function isClicked($button)
    {
        $stack    = $this->get('request_stack');
        $request  = $stack->getCurrentRequest();
        $data     = $request->request->all();
        $accessor = PropertyAccess::createPropertyAccessor();

        foreach (explode('.', $button) as $part) {
            if ($part === '*') {
                return true;
            }
            if (true === array_key_exists($part, $data)) {
                $data = $data[$part];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $event
     * @param mixed $object
     *
     * @return
     */
    public function dispatch($event, $object)
    {
        $this
            ->get('event_dispatcher')
            ->dispatch($event, new GenericEvent($object))
        ;
    }
}
