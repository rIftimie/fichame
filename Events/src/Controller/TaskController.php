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
    public function editState_request(Request $request, int $state_request,Task $task, TaskRepository $taskRepository): Response
    {
        
        

       //El estado 1 es Aceptado
       //El estado 0 es Rechazado

       //state;
       //El estado 1 es Asignado
       


            $task->setStateRequest($state_request);

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        

        
    }
    
    #[Route('/{id}/editState', name: 'app_task_edit_State', methods: ['GET', 'POST'])]
    public function editState(Request $request,Task $task, TaskRepository $taskRepository): Response
    {


      
           $tiempoDescanso = $request->get('tiempoDescanso');
        
           if($task->getStartTime()){

            $fecha = new \DateTime();
            $task->setEndTime($fecha);

           }else{

            $fecha = new \DateTime();
            $task->setStartTime($fecha);

           }
           

            

           
            
            
           


            $fecha = new \DateTime();
            $task->setStartTime($fecha);
            

        //    fechaActualMain=11
        //    empiezaEvento=10
        //    acabaEvento=13
        // fechaCracionTareaenBaseDAtos
        //    if(fechaActualMain>empiezaEvento && fechaActualMain<AcabaEvento &&fechaCreacionTarea!=fechaActualMain) crea tarea;
        //    else{
        //     state=2;Fin de evento
        //    }
            $task->setBreakTime($tiempoDescanso);
            

            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);

        }    
        #[Route('/{id}/editExtra}', name: 'app_task_edit_extra', methods: ['GET', 'POST'])]
    public function editExtra(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        
        $form = $this->createForm(EventType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($task);
            $task->setExtraTime($form->get('extra_time')->getData());
            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }
            dd($request); //Esto es a modo de prueba, ni caso
        

    }
    #[Route('/{id}/task',name: 'app_task_accepted')]
    public function getAcceptedTasks(Request $request, TaskRepository $taskRepository): Response{
        $tasks = $taskRepository->findBy(["state_request"=>'1',
                                          "User" => $this->getUser()->getId()
                                         ]);
        return $this->render('task/extra.html.twig', [
            'tasks' => $tasks,
        ]);
    }


}