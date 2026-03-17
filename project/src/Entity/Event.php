<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promo $promo_id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $start_date = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $end_date = null;

    #[ORM\Column(length: 255)]
    private ?string $classroom = null;

    #[ORM\Column(length: 255)]
    private ?string $speaker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromoId(): ?Promo
    {
        return $this->promo_id;
    }

    public function setPromoId(?Promo $promo_id): static
    {
        $this->promo_id = $promo_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTime $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTime $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getClassroom(): ?string
    {
        return $this->classroom;
    }

    public function setClassroom(string $classroom): static
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getSpeaker(): ?string
    {
        return $this->speaker;
    }

    public function setSpeaker(string $speaker): static
    {
        $this->speaker = $speaker;

        return $this;
    }
}
