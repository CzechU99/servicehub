<?php

namespace App\Entity;

use App\Repository\KategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KategorieRepository::class)]
class Kategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nazwaKategorii = null;

    /**
     * @var Collection<int, Uslugi>
     */
    #[ORM\ManyToMany(targetEntity: Uslugi::class, inversedBy: 'kategorie')]
    private Collection $uslugaKategoria;

    public function __construct()
    {
        $this->uslugaKategoria = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaKategorii(): ?string
    {
        return $this->nazwaKategorii;
    }

    public function setNazwaKategorii(string $nazwaKategorii): static
    {
        $this->nazwaKategorii = $nazwaKategorii;

        return $this;
    }

    /**
     * @return Collection<int, Uslugi>
     */
    public function getUslugaKategoria(): Collection
    {
        return $this->uslugaKategoria;
    }

    public function addUslugaKategorium(Uslugi $uslugaKategorium): static
    {
        if (!$this->uslugaKategoria->contains($uslugaKategorium)) {
            $this->uslugaKategoria->add($uslugaKategorium);
        }

        return $this;
    }

    public function removeUslugaKategorium(Uslugi $uslugaKategorium): static
    {
        $this->uslugaKategoria->removeElement($uslugaKategorium);

        return $this;
    }
}
