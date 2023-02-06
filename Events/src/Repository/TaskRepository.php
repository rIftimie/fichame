<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function save(Task $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Task $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createTask(Event $event, User $user): void
    {
        
        $task = new Task();
        $task->setUser($user);
        $task->setEvent($event);
        $this->save($task, true);

    }
   

   /**
    * @return Task[] Returns an array of Task objects
    */
   public function showPendingTasksByUser(User $user): array
   {

    $userId=$user->getId();
    
       return $this->createQueryBuilder('task')
           ->andWhere('task.state_request is NULL and task.User=:userId')
           ->setParameter('userId', $userId)
           ->getQuery()
           ->getResult()
       ;
   }

   public function showAsignByUser(User $user): array
   {

    $userId=$user->getId();
    
       return $this->createQueryBuilder('task')
           ->andWhere('task.state_request=3 and task.User=:userId')
           ->setParameter('userId', $userId)
           ->getQuery()
           ->getResult()
       ;
   }

   

//    public function findOneBySomeField($value): ?Task
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
