<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    #[ORM\Column(length: 255)]
    private ?string $linkInformation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eventCategory = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkForm = null;

    #[ORM\Column]
    private ?int $workers_number = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getLinkInformation(): ?string
    {
        return $this->linkInformation;
    }

    public function setLinkInformation(string $linkInformation): self
    {
        $this->linkInformation = $linkInformation;

        return $this;
    }

    public function getEventCategory(): ?string
    {
        return $this->eventCategory;
    }

    public function setEventCategory(?string $eventCategory): self
    {
        $this->eventCategory = $eventCategory;

        return $this;
    }

    public function getLinkForm(): ?string
    {
        return $this->linkForm;
    }

    public function setLinkForm(?string $linkForm): self
    {
        $this->linkForm = $linkForm;

        return $this;
    }

    public function getWorkersNumber(): ?int
    {
        return $this->workers_number;
    }

    public function setWorkersNumber(int $workers_number): self
    {
        $this->workers_number = $workers_number;

        return $this;
    }
}
