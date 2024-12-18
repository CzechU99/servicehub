<?php

namespace App\Entity;

use App\Repository\UslugiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UslugiRepository::class)]
class Uslugi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'uslugi')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $uzytkownik = null;

    #[ORM\Column(length: 255)]
    private ?string $nazwaUslugi = null;

    #[ORM\Column]
    private ?float $cena = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataDodania = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $glowneZdjecie = null;

    /**
     * @var Collection<int, Kategorie>
     */
    #[ORM\ManyToMany(targetEntity: Kategorie::class, mappedBy: 'uslugaKategoria')]
    private Collection $kategorie;

    #[ORM\Column(length: 1000)]
    private ?string $opisUslugi = null;

    #[ORM\Column]
    private ?bool $doNegocjacji = null;

    #[ORM\Column]
    private ?bool $czyFirma = null;

    #[ORM\Column]
    private ?bool $czyWymiana = null;

    #[ORM\Column]
    private ?bool $czyStawkaGodzinowa = null;

    /**
     * @var Collection<int, Rezerwacje>
     */
    #[ORM\OneToMany(targetEntity: Rezerwacje::class, mappedBy: 'uslugaDoRezerwacji', orphanRemoval: true)]
    private Collection $rezerwacje;

    #[ORM\Column(nullable: true)]
    private ?int $wyswietlenia = null;

    /**
     * @var Collection<int, Obserwowane>
     */
    #[ORM\OneToMany(targetEntity: Obserwowane::class, mappedBy: 'usluga', orphanRemoval: true)]
    private Collection $obserwowane;

    public function __construct()
    {
        $this->kategorie = new ArrayCollection();
        $this->rezerwacje = new ArrayCollection();
        $this->obserwowane = new ArrayCollection();
    }

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

    public function getNazwaUslugi(): ?string
    {
        return $this->nazwaUslugi;
    }

    public function setNazwaUslugi(string $nazwaUslugi): static
    {
        $this->nazwaUslugi = $nazwaUslugi;

        return $this;
    }

    public function getCena(): ?float
    {
        return $this->cena;
    }

    public function setCena(float $cena): static
    {
        $this->cena = $cena;

        return $this;
    }

    public function getDataDodania(): ?\DateTimeInterface
    {
        return $this->dataDodania;
    }

    public function setDataDodania(\DateTimeInterface $dataDodania): static
    {
        $this->dataDodania = $dataDodania;

        return $this;
    }

    public function getGlowneZdjecie(): ?string
    {
        return $this->glowneZdjecie;
    }

    public function setGlowneZdjecie(?string $glowneZdjecie): static
    {
        $this->glowneZdjecie = $glowneZdjecie;

        return $this;
    }

    /**
     * @return Collection<int, Kategorie>
     */
    public function getKategorie(): Collection
    {
        return $this->kategorie;
    }

    public function addKategorie(Kategorie $kategorie): static
    {
        if (!$this->kategorie->contains($kategorie)) {
            $this->kategorie->add($kategorie);
            $kategorie->addUslugaKategorium($this);
        }

        return $this;
    }

    public function removeKategorie(Kategorie $kategorie): static
    {
        if ($this->kategorie->removeElement($kategorie)) {
            $kategorie->removeUslugaKategorium($this);
        }

        return $this;
    }

    public function getOpisUslugi(): ?string
    {
        return $this->opisUslugi;
    }

    public function setOpisUslugi(string $opisUslugi): static
    {
        $this->opisUslugi = $opisUslugi;

        return $this;
    }

    public function isDoNegocjacji(): ?bool
    {
        return $this->doNegocjacji;
    }

    public function setDoNegocjacji(bool $doNegocjacji): static
    {
        $this->doNegocjacji = $doNegocjacji;

        return $this;
    }

    public function isCzyFirma(): ?bool
    {
        return $this->czyFirma;
    }

    public function setCzyFirma(bool $czyFirma): static
    {
        $this->czyFirma = $czyFirma;

        return $this;
    }

    public function isCzyWymiana(): ?bool
    {
        return $this->czyWymiana;
    }

    public function setCzyWymiana(bool $czyWymiana): static
    {
        $this->czyWymiana = $czyWymiana;

        return $this;
    }

    public function isCzyStawkaGodzinowa(): ?bool
    {
        return $this->czyStawkaGodzinowa;
    }

    public function setCzyStawkaGodzinowa(bool $czyStawkaGodzinowa): static
    {
        $this->czyStawkaGodzinowa = $czyStawkaGodzinowa;

        return $this;
    }

    /**
     * @return Collection<int, Rezerwacje>
     */
    public function getRezerwacje(): Collection
    {
        return $this->rezerwacje;
    }

    public function addRezerwacje(Rezerwacje $rezerwacje): static
    {
        if (!$this->rezerwacje->contains($rezerwacje)) {
            $this->rezerwacje->add($rezerwacje);
            $rezerwacje->setUslugaDoRezerwacji($this);
        }

        return $this;
    }

    public function removeRezerwacje(Rezerwacje $rezerwacje): static
    {
        if ($this->rezerwacje->removeElement($rezerwacje)) {
            // set the owning side to null (unless already changed)
            if ($rezerwacje->getUslugaDoRezerwacji() === $this) {
                $rezerwacje->setUslugaDoRezerwacji(null);
            }
        }

        return $this;
    }

    public function getWyswietlenia(): ?int
    {
        return $this->wyswietlenia;
    }

    public function setWyswietlenia(?int $wyswietlenia): static
    {
        $this->wyswietlenia = $wyswietlenia;

        return $this;
    }

    public function incrementWyswietlenia(): void
    {
        $this->wyswietlenia++;
    }

    /**
     * @return Collection<int, Obserwowane>
     */
    public function getObserwowane(): Collection
    {
        return $this->obserwowane;
    }

    public function addObserwowane(Obserwowane $obserwowane): static
    {
        if (!$this->obserwowane->contains($obserwowane)) {
            $this->obserwowane->add($obserwowane);
            $obserwowane->setUsluga($this);
        }

        return $this;
    }

    public function removeObserwowane(Obserwowane $obserwowane): static
    {
        if ($this->obserwowane->removeElement($obserwowane)) {
            // set the owning side to null (unless already changed)
            if ($obserwowane->getUsluga() === $this) {
                $obserwowane->setUsluga(null);
            }
        }

        return $this;
    }

}
