<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $internalUser;

    /**
     * @ORM\OneToMany(targetEntity=InternalLocation::class, mappedBy="user")
     */
    private $internalLocations;

    /**
     * @ORM\OneToMany(targetEntity=ExternalLocation::class, mappedBy="user")
     */
    private $externalLocations;

    public function __toString()
    {
        return $this->internalUser;
    }

    public function __construct()
    {
        $this->internalLocations = new ArrayCollection();
        $this->externalLocations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getInternalUser(): ?string
    {
        return $this->internalUser;
    }

    public function setInternalUser(string $internalUser): self
    {
        $this->internalUser = $internalUser;

        return $this;
    }

    /**
     * @return Collection<int, InternalLocation>
     */
    public function getInternalLocations(): Collection
    {
        return $this->internalLocations;
    }

    public function addInternalLocation(InternalLocation $internalLocation): self
    {
        if (!$this->internalLocations->contains($internalLocation)) {
            $this->internalLocations[] = $internalLocation;
            $internalLocation->setUser($this);
        }

        return $this;
    }

    public function removeInternalLocation(InternalLocation $internalLocation): self
    {
        if ($this->internalLocations->removeElement($internalLocation)) {
            // set the owning side to null (unless already changed)
            if ($internalLocation->getUser() === $this) {
                $internalLocation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExternalLocation>
     */
    public function getExternalLocations(): Collection
    {
        return $this->externalLocations;
    }

    public function addExternalLocation(ExternalLocation $externalLocation): self
    {
        if (!$this->externalLocations->contains($externalLocation)) {
            $this->externalLocations[] = $externalLocation;
            $externalLocation->setUser($this);
        }

        return $this;
    }

    public function removeExternalLocation(ExternalLocation $externalLocation): self
    {
        if ($this->externalLocations->removeElement($externalLocation)) {
            // set the owning side to null (unless already changed)
            if ($externalLocation->getUser() === $this) {
                $externalLocation->setUser(null);
            }
        }

        return $this;
    }
    
}
