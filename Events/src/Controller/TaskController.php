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
            'tasks' => $taskRepository->findAll(),
            'allMyTasks' => $taskRepository->findByUser($this->getUser()),

        ]);
    }

    #[Route('/{id}/edit/{state_request}', name: 'app_task_edit_State_request', methods: ['GET', 'POST'])]
    public function editState_request(Request $request, int $state_request, Task $task, TaskRepository $taskRepository): Response
    {



        //El estado 1 es Aceptado
        //El estado 0 es Rechazado

        $fecha = new \DateTime();
        $task->setStateRequest($state_request);
        $task->setStatusResolveDate($fecha);

        $taskRepository->save($task, true);

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);


    }

    #[Route('/{id}/updateState', name: 'app_task_update_State', methods: ['GET', 'POST'])]
    public function UpdateState(Request $request, Task $task, TaskRepository $taskRepository): Response
    {

        //En state 1 es Asignado
        //En state NULL es no asignado

        $breakTime = $request->get("breakHours");
        if (!$breakTime)
            $breakTime = 0;

        $task->setBreakTime($breakTime);


        // $task->setState($state);

        // $state= $task->isState();


        if ($task->getStartTime() != NULL) {
            $fecha = new \DateTime();
            $task->setEndTime($fecha);

        } else {
            $fecha = new \DateTime();
            $task->setStartTime($fecha);


        }






        // $state_request=2;


        // $task->setStateRequest($state_request);
        $taskRepository->save($task, true);



        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);



    }
    #[Route('/seeAsignedTasks', name: 'app_seeAsignedTasks', methods: ['GET', 'POST'])]

    public function seeAsignedTasks(Request $request, TaskRepository $taskRepository): Response
    {
        $tasks = $taskRepository->findAllBy([
            'state => 1',
            'user => ' + $this->getUser()
        ]
        );

        return $this->redirectToRoute('task/index.html.twig',[
            'tasks' => $tasks
        ]);

    }

    #[Route('/seeTaskToday', name: 'app_ seeTaskToday', methods: ['GET', 'POST'])]
    public function seeTaskToday(Request $request, TaskRepository $taskRepository): Response
    {

        /* Hoy de mañana
        $hoy= new \DateTime('2023-02-11');*/

        //hoy de hoy 
        $hoy = new \DateTime();
        $tomorrow = new \DateTime('2023-02-11');


        return $this->render('task/taskfull.html.twig', [
            'tasks' => $taskRepository->findAll(),
            'hoy' => $hoy,
            'tomorrow' => $tomorrow,

        ]);



    }
}