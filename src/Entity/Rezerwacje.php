<?php

namespace App\Entity;

use App\Repository\RezerwacjeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RezerwacjeRepository::class)]
class Rezerwacje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rezerwacje')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $uzytkownikId = null;

    #[ORM\ManyToOne(inversedBy: 'rezerwacje')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Uslugi $uslugaDoRezerwacji = null;

    #[ORM\ManyToOne]
    private ?Uslugi $uslugaNaWymiane = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $wiadomosc = null;

    #[ORM\Column(nullable: true)]
    private ?bool $udostepnijTelefon = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $odKiedy = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $doKiedy = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataZlozenia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUzytkownikId(): ?User
    {
        return $this->uzytkownikId;
    }

    public function setUzytkownikId(?User $uzytkownikId): static
    {
        $this->uzytkownikId = $uzytkownikId;

        return $this;
    }

    public function getUslugaDoRezerwacji(): ?Uslugi
    {
        return $this->uslugaDoRezerwacji;
    }

    public function setUslugaDoRezerwacji(?Uslugi $uslugaDoRezerwacji): static
    {
        $this->uslugaDoRezerwacji = $uslugaDoRezerwacji;

        return $this;
    }

    public function getUslugaNaWymiane(): ?Uslugi
    {
        return $this->uslugaNaWymiane;
    }

    public function setUslugaNaWymiane(?Uslugi $uslugaNaWymiane): static
    {
        $this->uslugaNaWymiane = $uslugaNaWymiane;

        return $this;
    }

    public function getWiadomosc(): ?string
    {
        return $this->wiadomosc;
    }

    public function setWiadomosc(?string $wiadomosc): static
    {
        $this->wiadomosc = $wiadomosc;

        return $this;
    }

    public function isUdostepnijTelefon(): ?bool
    {
        return $this->udostepnijTelefon;
    }

    public function setUdostepnijTelefon(?bool $udostepnijTelefon): static
    {
        $this->udostepnijTelefon = $udostepnijTelefon;

        return $this;
    }

    public function getOdKiedy(): ?\DateTimeInterface
    {
        return $this->odKiedy;
    }

    public function setOdKiedy(\DateTimeInterface $odKiedy): static
    {
        $this->odKiedy = $odKiedy;

        return $this;
    }

    public function getDoKiedy(): ?\DateTimeInterface
    {
        return $this->doKiedy;
    }

    public function setDoKiedy(?\DateTimeInterface $doKiedy): static
    {
        $this->doKiedy = $doKiedy;

        return $this;
    }

    public function getDataZlozenia(): ?\DateTimeInterface
    {
        return $this->dataZlozenia;
    }

    public function setDataZlozenia(\DateTimeInterface $dataZlozenia): static
    {
        $this->dataZlozenia = $dataZlozenia;

        return $this;
    }
}
