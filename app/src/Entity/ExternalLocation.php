<?php

namespace App\Entity;

use App\Repository\ExternalLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExternalLocationRepository::class)
 */
class ExternalLocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $externalUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEnd;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="externalLocations")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Laptop::class, inversedBy="externalLocations")
     */
    private $laptop;

    /**
     * @ORM\ManyToMany(targetEntity=Mouse::class, inversedBy="externalLocations")
     */
    private $mouse;

    /**
     * @ORM\ManyToMany(targetEntity=Keyboard::class, inversedBy="externalLocations")
     */
    private $keyboard;


    public function __construct()
    {
        $this->laptop = new ArrayCollection();
        $this->mouse = new ArrayCollection();
        $this->keyboard = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalUser(): ?string
    {
        return $this->externalUser;
    }

    public function setExternalUser(string $externalUser): self
    {
        $this->externalUser = $externalUser;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Laptop>
     */
    public function getLaptop(): Collection
    {
        return $this->laptop;
    }

    public function addLaptop(Laptop $laptop): self
    {
        if (!$this->laptop->contains($laptop)) {
            $this->laptop[] = $laptop;
        }

        return $this;
    }

    public function removeLaptop(Laptop $laptop): self
    {
        $this->laptop->removeElement($laptop);

        return $this;
    }

    /**
     * @return Collection<int, Mouse>
     */
    public function getMouse(): Collection
    {
        return $this->mouse;
    }

    public function addMouse(Mouse $mouse): self
    {
        if (!$this->mouse->contains($mouse)) {
            $this->mouse[] = $mouse;
        }

        return $this;
    }

    public function removeMouse(Mouse $mouse): self
    {
        $this->mouse->removeElement($mouse);

        return $this;
    }

    /**
     * @return Collection<int, Keyboard>
     */
    public function getKeyboard(): Collection
    {
        return $this->keyboard;
    }

    public function addKeyboard(Keyboard $keyboard): self
    {
        if (!$this->keyboard->contains($keyboard)) {
            $this->keyboard[] = $keyboard;
        }

        return $this;
    }

    public function removeKeyboard(Keyboard $keyboard): self
    {
        $this->keyboard->removeElement($keyboard);

        return $this;
    }

}
