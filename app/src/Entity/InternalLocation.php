<?php

namespace App\Entity;

use App\Repository\InternalLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternalLocationRepository::class)
 */
class InternalLocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="internalLocations")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Computer::class, cascade={"persist", "remove"})
     */
    private $computer;

    /**
     * @ORM\OneToOne(targetEntity=Laptop::class, cascade={"persist", "remove"})
     */
    private $laptop;

    /**
     * @ORM\OneToOne(targetEntity=Monitor::class, cascade={"persist", "remove"})
     */
    private $monitor;

    /**
     * @ORM\OneToOne(targetEntity=Videoprojector::class, cascade={"persist", "remove"})
     */
    private $videoprojector;

    /**
     * @ORM\OneToOne(targetEntity=Mouse::class, cascade={"persist", "remove"})
     */
    private $mouse;

    /**
     * @ORM\OneToOne(targetEntity=Keyboard::class, cascade={"persist", "remove"})
     */
    private $keyboard;

    
    public function getId(): ?int
    {
        return $this->id;
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

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

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

    public function getComputer(): ?Computer
    {
        return $this->computer;
    }

    public function setComputer(?Computer $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getLaptop(): ?Laptop
    {
        return $this->laptop;
    }

    public function setLaptop(?Laptop $laptop): self
    {
        $this->laptop = $laptop;

        return $this;
    }

    public function getMonitor(): ?Monitor
    {
        return $this->monitor;
    }

    public function setMonitor(?Monitor $monitor): self
    {
        $this->monitor = $monitor;

        return $this;
    }

    public function getVideoprojector(): ?Videoprojector
    {
        return $this->videoprojector;
    }

    public function setVideoprojector(?Videoprojector $videoprojector): self
    {
        $this->videoprojector = $videoprojector;

        return $this;
    }

    public function getMouse(): ?Mouse
    {
        return $this->mouse;
    }

    public function setMouse(?Mouse $mouse): self
    {
        $this->mouse = $mouse;

        return $this;
    }

    public function getKeyboard(): ?Keyboard
    {
        return $this->keyboard;
    }

    public function setKeyboard(?Keyboard $keyboard): self
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    
}
