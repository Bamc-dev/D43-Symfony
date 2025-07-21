<?php

namespace App\Document;

use App\Repository\ReservationRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Types\Type;

#[ODM\Document(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ODM\Id]
    private ?string $id = null;

    #[ODM\Field(type: Type::DATE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ODM\Field(type: Type::DATE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ODM\ReferenceOne(targetDocument: Client::class, inversedBy: 'reservations')]
    private ?Client $client = null;

    #[ODM\ReferenceOne(targetDocument: Chambre::class, inversedBy: 'reservations')]
    private ?Chambre $chambre = null;

    #[ODM\ReferenceOne(targetDocument: Hotel::class, inversedBy: 'reservations')]
    private ?Hotel $hotel = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): static
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }
}
