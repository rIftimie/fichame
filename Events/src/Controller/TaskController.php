<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TaskRepository;
use App\Entity\Task;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    #[Route('/{id}/edit/{state}', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $state, Task $task, TaskRepository $taskRepository): Response
    {
        //El estado 1 es Aceptado
        //El estado 2 es Rechazado
        //El estado 3 es Asignado
        //El estado 4 es Terminado

        $task->setStateRequest($state);

        if ($state == 1) {
            return $this->render('task/extra.html.twig', [
                $task => 'task',
            ]);
        } else {

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);

        }


    }
    #[Route('/{id}/task/{extra}')]
    public function editExtra(Request $request,int $extra, Task $task, TaskRepository $taskRepository): Response
    {
        
        $form = $this->createForm(EventType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setExtraTime($extra);

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

    }
    #[Route('/{id}/task')]
    public function getAcceptedTasks(Request $request, TaskRepository $taskRepository): Response{

    }


}