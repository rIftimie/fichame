<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_time = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_time = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state_request = null;

    #[ORM\Column(nullable: true)]
    private ?int $extra_time = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?Event $Event = null;

    #[ORM\Column(nullable: true)]
    private ?int $breakTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $statusResolveDate = null;

    #[ORM\Column]
    private ?int $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStart_Time(?\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    public function setEnd_Time(?\DateTimeInterface $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getStateRequest(): ?string
    {
        return $this->state_request;
    }

    public function setStateRequest(?string $state_request): self
    {
        $this->state_request = $state_request;

        return $this;
    }

    public function getExtraTime()
    {
        return $this->extra_time;
    }

    public function setExtraTime( $extra_time): self
    {
        $this->extra_time = $extra_time;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): self
    {
        $this->Event = $Event;

        return $this;
    }

    public function getBreakTime(): ?int
    {
        return $this->breakTime;
    }

    public function setBreakTime(?int $breakTime): self
    {
        $this->breakTime = $breakTime;

        return $this;
    }

    public function getStatusResolveDate(): ?\DateTimeInterface
    {
        return $this->statusResolveDate;
    }

    public function setStatusResolveDate(?\DateTimeInterface $statusResolveDate): self
    {
        $this->statusResolveDate = $statusResolveDate;

        return $this;
    }
    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getTaskId() === $this) {
                $job->setTaskId(null);
            }
        }

        return $this;
    }
    public function __toString(): string {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getExtraTime(): ?int
    {
        return $this->extra_time;
    }

    public function setExtraTime(?int $extra_time): self
    {
        $this->extra_time = $extra_time;
    }

    public function getChore(): array
    {
        return $this->chore;
    }

    public function setChore(?array $chore): self
    {
        $this->chore = $chore;

        return $this;
    }
}
