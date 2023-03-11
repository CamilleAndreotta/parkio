<?php

namespace App\Entity;

use App\Repository\KeyboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KeyboardRepository::class)
 */
class Keyboard
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
    private $affectation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=ExternalLocation::class, mappedBy="keyboard")
     */
    private $externalLocations;

    /**
     * @ORM\ManyToMany(targetEntity=InternalLocation::class, mappedBy="keyboard")
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
            $externalLocation->addKeyboard($this);
        }

        return $this;
    }

    public function removeExternalLocation(ExternalLocation $externalLocation): self
    {
        if ($this->externalLocations->removeElement($externalLocation)) {
            $externalLocation->removeKeyboard($this);
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
            $internalLocation->addKeyboard($this);
        }

        return $this;
    }

    public function removeInternalLocation(InternalLocation $internalLocation): self
    {
        if ($this->internalLocations->removeElement($internalLocation)) {
            $internalLocation->removeKeyboard($this);
        }

        return $this;
    }
}
