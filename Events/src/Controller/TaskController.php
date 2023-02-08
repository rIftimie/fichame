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

    #[Route('/{id}/edit/{state_request}', name: 'app_task_edit_State_request', methods: ['GET', 'POST'])]
    public function editState_request(Request $request, int $state_request,Task $task, TaskRepository $taskRepository): Response
    {
        //El estado 1 es Aceptado
        //El estado 2 es Rechazado
        //El estado 3 es Asignado
        //El estado 4 es Terminado
            $task->setStateRequest($state_request);

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        

        
    }
    
    #[Route('/{id}/editState/{state}/{}', name: 'app_task_edit_State', methods: ['GET', 'POST'])]
    public function editState(Request $request, int $state,Task $task, TaskRepository $taskRepository): Response
    {


       //En state 1 es Comenzado
       //En state 2 es parado
        
            $task->setState($state);

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);

        }    
        #[Route('/{id}/editExtra', name: 'app_task_edit_extra', methods: ['GET', 'POST'])]
    public function editExtra(Request $request,int $extra, Task $task, TaskRepository $taskRepository): Response
    {
        
        $form = $this->createForm(EventType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setExtraTime($extra);

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }else{
            dd($request); //Esto es a modo de prueba, ni caso
        }

    }
    #[Route('/{id}/task',name: 'app_task_accepted')]
    public function getAcceptedTasks(Request $request, TaskRepository $taskRepository): Response{
        $tasks = $taskRepository->findBy(["state_request"=>'1']);
        return $this->render('task/extra.html.twig', [
            'tasks' => $tasks,
        ]);
    }


}