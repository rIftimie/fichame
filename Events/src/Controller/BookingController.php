<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route('/', name: 'app_booking_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        return $this->render('booking/index.html.twig', [
            'PendingTasks' => $taskRepository->showPendingTasksByUser($this->getUser()),
            'AcceptedTasks' => $taskRepository->showAcceptedTasksByUser($this->getUser()),
            'AssignedTasks' => $taskRepository->showAssignByUser($this->getUser()),
        ]);
    }
}