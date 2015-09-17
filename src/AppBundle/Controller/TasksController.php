<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Event\Task as TaskEvents;
use AppBundle\Form\Type\AdvancedTaskType;
use AppBundle\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;

class TasksController extends Controller
{
    public function indexAction()
    {
        $tasks = $this->getRepository('AppBundle:Task')->findAll();

        $form = $this->createForm('task', null, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_tasks_simple_create'),
        ]);

        return $this
            ->render('AppBundle:Tasks:index.html.twig', [
                'tasks' => $tasks,
                'form'  => $form->createView(),
            ])
        ;
    }

    public function deleteAction($task)
    {
        $task = $this
            ->getRepository('AppBundle:Task')
            ->find($task)
        ;

        $this->remove($task);
        $this->flush();

        return $this->redirectToRoute('app_tasks_index');
    }

    public function updateAction(Request $request, $task)
    {
        $task = $this
            ->getRepository('AppBundle:Task')
            ->find($task)
        ;

        $form = $this->createForm('advanced_task', $task, [
            'method' => 'PUT',
            'action' => $this->generateUrl('app_tasks_update', ['task' => $task->getId()]),
        ]);

        $form->handleRequest($request);
        if (true === $form->isValid()) {
            if (false === $this->isClicked('advanced_task.plus') && false === $this->isClicked('advanced_task.removes.*')) {
                $this->flush();

                return $this->redirectToRoute('app_tasks_index');
            }
        }

        return $this
            ->render('AppBundle:Tasks:update.html.twig', [
                'form' => $form->createView(),
            ])
        ;
    }
}
