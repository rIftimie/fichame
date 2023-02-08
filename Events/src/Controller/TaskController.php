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
    public function index(TaskRepository $taskRepository): Response
    {


        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'tasks' => $taskRepository->findAll()

        ]);
    }

    #[Route('/{id}/edit/{state_request}', name: 'app_task_edit_State_request', methods: ['GET', 'POST'])]
    public function editState_request(Request $request, int $state_request, Task $task, TaskRepository $taskRepository): Response
    {



        //El estado 1 es Aceptado
        //El estado 2 es Rechazado
        //El estado 3 es Asignado
        //El estado 4 es Terminado

        $task->setStateRequest($state);

        $taskRepository->save($task, true);

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);



    }

    #[Route('/{id}/editState/{state}', name: 'app_task_edit_State', methods: ['GET', 'POST'])]
    public function editState(Request $request, int $state,Task $task, TaskRepository $taskRepository): Response
    {


       //En state 1 es Comenzado
       //En state 2 es parado
        
            $task->setState($state);

            // $task->setBreakTime($break);

            $taskRepository->save($task, true);

            // $taskRepository->save($break, true);


            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        

        
    }
    #[Route('/{id}/updateState/{state}', name: 'app_task_update_State', methods: ['GET', 'POST'])]
    public function UpdateState(Request $request, int $state, Task $task, TaskRepository $taskRepository): Response
    {
        
        $breakTime=$request->get("breakHours");

        $task->setBreakTime($breakTime);


        $task->setState($state);

        echo $task->getStateRequest();


        $taskRepository->save($task, true);



        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        
        

        
    }





}