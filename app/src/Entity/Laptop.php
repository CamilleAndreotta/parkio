<?php

namespace App\Entity;

use App\Repository\LaptopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaptopRepository::class)
 */
class Laptop
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
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="date")
     */
    private $purchaseDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $affectation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=ExternalLocation::class, mappedBy="laptop")
     */
    private $externalLocations;

    /**
     * @ORM\ManyToMany(targetEntity=InternalLocation::class, mappedBy="laptop")
     */
    private $internalLocations;

    public function __construct()
    {
        $this->externalLocations = new ArrayCollection();
        $this->internalLocations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTimeInterface $purchaseDate): self
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getAffectation(): ?string
    {
        return $this->affectation;
    }

    public function setAffectation(string $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
            $externalLocation->addLaptop($this);
        }

        return $this;
    }

    public function removeExternalLocation(ExternalLocation $externalLocation): self
    {
        if ($this->externalLocations->removeElement($externalLocation)) {
            $externalLocation->removeLaptop($this);
        }

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
            $internalLocation->addLaptop($this);
        }

        return $this;
    }

    public function removeInternalLocation(InternalLocation $internalLocation): self
    {
        if ($this->internalLocations->removeElement($internalLocation)) {
            $internalLocation->removeLaptop($this);
        }

        return $this;
    }
}
