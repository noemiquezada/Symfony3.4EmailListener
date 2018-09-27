<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{
    /**
     * List all Task entities.
     *
     * @Route("/", name="task_index")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository(Task::class)->findAll();

        return $this->render('@App/task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Creates a new task entity.
     *
     * @Route("/task/new", name="task_new")
     */
    public function newAction(Request $request) {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_index');
        }

        return $this->render('@App/task/new.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
}
