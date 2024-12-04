<?php

namespace App\Entity;

use App\Repository\DaneUzytkownikaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DaneUzytkownikaRepository::class)]
class DaneUzytkownika
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'daneUzytkownika', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $uzytkownik = null;

    #[ORM\Column(length: 255)]
    private ?string $imie = null;

    #[ORM\Column(length: 255)]
    private ?string $nazwisko = null;

    #[ORM\Column(length: 255)]
    private ?string $miejscowosc = null;

    #[ORM\Column(length: 255)]
    private ?string $numerDomu = null;

    #[ORM\Column(length: 255)]
    private ?string $kodPocztowy = null;

    #[ORM\Column(length: 255)]
    private ?string $miasto = null;

    #[ORM\Column(length: 255)]
    private ?string $telefon = null;

    #[ORM\Column]
    private ?float $szerokoscGeograficzna = null;

    #[ORM\Column]
    private ?float $dlugoscGeograficzna = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUzytkownik(): ?User
    {
        return $this->uzytkownik;
    }

    public function setUzytkownik(User $uzytkownik): static
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): static
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(string $nazwisko): static
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getMiejscowosc(): ?string
    {
        return $this->miejscowosc;
    }

    public function setMiejscowosc(string $miejscowosc): static
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    public function getNumerDomu(): ?string
    {
        return $this->numerDomu;
    }

    public function setNumerDomu(string $numerDomu): static
    {
        $this->numerDomu = $numerDomu;

        return $this;
    }

    public function getKodPocztowy(): ?string
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy(string $kodPocztowy): static
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    public function getMiasto(): ?string
    {
        return $this->miasto;
    }

    public function setMiasto(string $miasto): static
    {
        $this->miasto = $miasto;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): static
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getSzerokoscGeograficzna(): ?float
    {
        return $this->szerokoscGeograficzna;
    }

    public function setSzerokoscGeograficzna(float $szerokoscGeograficzna): static
    {
        $this->szerokoscGeograficzna = $szerokoscGeograficzna;

        return $this;
    }

    public function getDlugoscGeograficzna(): ?float
    {
        return $this->dlugoscGeograficzna;
    }

    public function setDlugoscGeograficzna(float $dlugoscGeograficzna): static
    {
        $this->dlugoscGeograficzna = $dlugoscGeograficzna;

        return $this;
    }
}
