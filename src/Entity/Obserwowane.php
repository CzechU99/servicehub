<?php

namespace App\Entity;

use App\Repository\ObserwowaneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObserwowaneRepository::class)]
class Obserwowane
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'obserwowane')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $uzytkownik = null;

    #[ORM\ManyToOne(inversedBy: 'obserwowane')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Uslugi $usluga = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUzytkownik(): ?User
    {
        return $this->uzytkownik;
    }

    public function setUzytkownik(?User $uzytkownik): static
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    public function getUsluga(): ?Uslugi
    {
        return $this->usluga;
    }

    public function setUsluga(?Uslugi $usluga): static
    {
        $this->usluga = $usluga;

        return $this;
    }
}
