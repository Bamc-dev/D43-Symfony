<?php

namespace App\Document;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(repositoryClass: ClientRepository::class)]
class Client
{
    #[ODM\Id]
    private ?string $id = null;

    #[ODM\Field]
    private ?string $nameClient = null;

    #[ODM\Field]
    private ?string $addrrClient = null;

    #[ODM\ReferenceMany(targetDocument: Reservation::class, mappedBy: 'client')]
    private Collection $reservations;

    #[ODM\ReferenceOne(targetDocument: User::class, cascade: ['persist', 'remove'], mappedBy: 'client')]
    private ?User $user = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNameClient(): ?string
    {
        return $this->nameClient;
    }

    public function setNameClient(string $nameClient): static
    {
        $this->nameClient = $nameClient;

        return $this;
    }

    public function getAddrrClient(): ?string
    {
        return $this->addrrClient;
    }

    public function setAddrrClient(string $addrrClient): static
    {
        $this->addrrClient = $addrrClient;

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
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getClient() !== $this) {
            $user->setClient($this);
        }

        $this->user = $user;

        return $this;
    }
}
