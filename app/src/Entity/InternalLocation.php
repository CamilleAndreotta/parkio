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
     * @ORM\ManyToMany(targetEntity=Laptop::class, inversedBy="internalLocations")
     */
    private $laptop;

    /**
     * @ORM\ManyToMany(targetEntity=Computer::class, inversedBy="internalLocations")
     */
    private $computer;

    /**
     * @ORM\ManyToMany(targetEntity=Monitor::class, inversedBy="internalLocations")
     */
    private $monitor;

    /**
     * @ORM\ManyToMany(targetEntity=Videoprojector::class, inversedBy="internalLocations")
     */
    private $videoprojector;

    /**
     * @ORM\ManyToMany(targetEntity=Mouse::class, inversedBy="internalLocations")
     */
    private $mouse;

    /**
     * @ORM\ManyToMany(targetEntity=Keyboard::class, inversedBy="internalLocations")
     */
    private $keyboard;

    public function __construct()
    {
        $this->laptop = new ArrayCollection();
        $this->computer = new ArrayCollection();
        $this->monitor = new ArrayCollection();
        $this->videoprojector = new ArrayCollection();
        $this->mouse = new ArrayCollection();
        $this->keyboard = new ArrayCollection();
    }

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
     * @return Collection<int, Computer>
     */
    public function getComputer(): Collection
    {
        return $this->computer;
    }

    public function addComputer(Computer $computer): self
    {
        if (!$this->computer->contains($computer)) {
            $this->computer[] = $computer;
        }

        return $this;
    }

    public function removeComputer(Computer $computer): self
    {
        $this->computer->removeElement($computer);

        return $this;
    }

    /**
     * @return Collection<int, Monitor>
     */
    public function getMonitor(): Collection
    {
        return $this->monitor;
    }

    public function addMonitor(Monitor $monitor): self
    {
        if (!$this->monitor->contains($monitor)) {
            $this->monitor[] = $monitor;
        }

        return $this;
    }

    public function removeMonitor(Monitor $monitor): self
    {
        $this->monitor->removeElement($monitor);

        return $this;
    }

    /**
     * @return Collection<int, Videoprojector>
     */
    public function getVideoprojector(): Collection
    {
        return $this->videoprojector;
    }

    public function addVideoprojector(Videoprojector $videoprojector): self
    {
        if (!$this->videoprojector->contains($videoprojector)) {
            $this->videoprojector[] = $videoprojector;
        }

        return $this;
    }

    public function removeVideoprojector(Videoprojector $videoprojector): self
    {
        $this->videoprojector->removeElement($videoprojector);

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

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
