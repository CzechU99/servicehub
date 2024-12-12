<?php

namespace App\Entity;

use App\Entity\DaneUzytkownika;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'uzytkownik', cascade: ['persist', 'remove'])]
    private ?DaneUzytkownika $daneUzytkownika = null;

    #[ORM\OneToMany(targetEntity: Uslugi::class, mappedBy: 'uzytkownik', orphanRemoval: true)]
    private Collection $uslugi;

    /**
     * @var Collection<int, Rezerwacje>
     */
    #[ORM\OneToMany(targetEntity: Rezerwacje::class, mappedBy: 'uzytkownikId', orphanRemoval: true)]
    private Collection $rezerwacje;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $resetTokenWaznosc = null;

    /**
     * @var Collection<int, Obserwowane>
     */
    #[ORM\OneToMany(targetEntity: Obserwowane::class, mappedBy: 'uzytkownik', orphanRemoval: true)]
    private Collection $obserwowane;

    public function __construct()
    {
        $this->uslugi = new ArrayCollection();
        $this->rezerwacje = new ArrayCollection();
        $this->obserwowane = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDaneUzytkownika(): ?DaneUzytkownika
    {
        return $this->daneUzytkownika;
    }

    public function setDaneUzytkownika(DaneUzytkownika $daneUzytkownika): static
    {
        // set the owning side of the relation if necessary
        if ($daneUzytkownika->getUzytkownik() !== $this) {
            $daneUzytkownika->setUzytkownik($this);
        }

        $this->daneUzytkownika = $daneUzytkownika;

        return $this;
    }

    /**
     * @return Collection<int, Uslugi>
     */
    public function getUslugi(): Collection
    {
        return $this->uslugi;
    }

    public function addUslugi(Uslugi $uslugi): static
    {
        if (!$this->uslugi->contains($uslugi)) {
            $this->uslugi->add($uslugi);
            $uslugi->setUzytkownik($this);
        }

        return $this;
    }

    public function removeUslugi(Uslugi $uslugi): static
    {
        if ($this->uslugi->removeElement($uslugi)) {
            // set the owning side to null (unless already changed)
            if ($uslugi->getUzytkownik() === $this) {
                $uslugi->setUzytkownik(null);
            }
        }

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
            $rezerwacje->setUzytkownikId($this);
        }

        return $this;
    }

    public function removeRezerwacje(Rezerwacje $rezerwacje): static
    {
        if ($this->rezerwacje->removeElement($rezerwacje)) {
            // set the owning side to null (unless already changed)
            if ($rezerwacje->getUzytkownikId() === $this) {
                $rezerwacje->setUzytkownikId(null);
            }
        }

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): static
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    public function getResetTokenWaznosc(): ?\DateTimeInterface
    {
        return $this->resetTokenWaznosc;
    }

    public function setResetTokenWaznosc(?\DateTimeInterface $resetTokenWaznosc): static
    {
        $this->resetTokenWaznosc = $resetTokenWaznosc;

        return $this;
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
            $obserwowane->setUzytkownik($this);
        }

        return $this;
    }

    public function removeObserwowane(Obserwowane $obserwowane): static
    {
        if ($this->obserwowane->removeElement($obserwowane)) {
            // set the owning side to null (unless already changed)
            if ($obserwowane->getUzytkownik() === $this) {
                $obserwowane->setUzytkownik(null);
            }
        }

        return $this;
    }

}
