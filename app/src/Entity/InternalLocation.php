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
     * @ORM\ManyToMany(targetEntity=ExternalLocation::class, mappedBy="InternalLocation")
     */
    private $externalLocations;

    /**
     * @ORM\ManyToMany(targetEntity=Material::class, inversedBy="internalLocations")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="internalLocations")
     */
    private $user;

    public function __construct()
    {
        $this->externalLocations = new ArrayCollection();
        $this->material = new ArrayCollection();
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
            $externalLocation->addInternalLocation($this);
        }

        return $this;
    }

    public function removeExternalLocation(ExternalLocation $externalLocation): self
    {
        if ($this->externalLocations->removeElement($externalLocation)) {
            $externalLocation->removeInternalLocation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Material>
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->material->contains($material)) {
            $this->material[] = $material;
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        $this->material->removeElement($material);

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
}
