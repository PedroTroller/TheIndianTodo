<?php

namespace AppBundle\EventListener;

use AppBundle\Event\Task;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class TaskNotificationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            Task::POST_CREATION => 'sendNotification',
        ];
    }

    public function sendNotification(GenericEvent $event)
    {
        dump($event);
    }
}
