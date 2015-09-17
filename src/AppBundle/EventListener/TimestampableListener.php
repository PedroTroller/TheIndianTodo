<?php

namespace AppBundle\EventListener;

use AppBundle\Behavior\Timestampable;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TimestampableListener
{
    public function prePersist(LifecycleEventArgs $event)
    {
        $object = $event->getObject();
        if (false === $object instanceof Timestampable) {
            return;
        }

        $object->setCreatedAt(new \DateTime());
        $object->setUpdatedAt(new \DateTime());

        var_dump($object);
    }

    public function preUpdate(LifecycleEventArgs $event)
    {
        $object = $event->getObject();

        if (false === $object instanceof Timestampable) {
            return;
        }

        $object->setUpdatedAt(new \DateTime());
    }
}
