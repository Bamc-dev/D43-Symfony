<?php

namespace App\Document;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ODM\Id]
    private ?string $id = null;

    #[ODM\Field]
    private ?string $nameHotel = null;

    #[ODM\Field]
    private ?string $addrrHotel = null;

    #[ODM\Field]
    private ?string $catHotel = null;

    #[ODM\ReferenceMany(targetDocument: Reservation::class, mappedBy: 'hotel')]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNameHotel(): ?string
    {
        return $this->nameHotel;
    }

    public function setNameHotel(string $nameHotel): static
    {
        $this->nameHotel = $nameHotel;

        return $this;
    }

    public function getAddrrHotel(): ?string
    {
        return $this->addrrHotel;
    }

    public function setAddrrHotel(string $addrrHotel): static
    {
        $this->addrrHotel = $addrrHotel;

        return $this;
    }

    public function getCatHotel(): ?string
    {
        return $this->catHotel;
    }

    public function setCatHotel(string $catHotel): static
    {
        $this->catHotel = $catHotel;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setHotel($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getHotel() === $this) {
                $reservation->setHotel(null);
            }
        }

        return $this;
    }
}
