<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle
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
    private $numberCv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numberCg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numberIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insExp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numberVtcCard;

    /**
     * @ORM\Column(type="datetime")
     */
    private $vtcCardExp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="vehicles")
     */
    private $driver;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAvaliable;

    /**
     * @ORM\OneToOne(targetEntity=File::class, inversedBy="vehicle", cascade={"persist", "remove"})
     */
    private $carteGrise;

    /**
     * @ORM\OneToOne(targetEntity=File::class, cascade={"persist", "remove"})
     */
    private $vtcCard;

    public function __construct()
    {
        $this->driver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberCv(): ?string
    {
        return $this->numberCv;
    }

    public function setNumberCv(string $numberCv): self
    {
        $this->numberCv = $numberCv;

        return $this;
    }

    public function getNumberCg(): ?string
    {
        return $this->numberCg;
    }

    public function setNumberCg(string $numberCg): self
    {
        $this->numberCg = $numberCg;

        return $this;
    }

    public function getNumberIns(): ?string
    {
        return $this->numberIns;
    }

    public function setNumberIns(string $numberIns): self
    {
        $this->numberIns = $numberIns;

        return $this;
    }

    public function getInsExp(): ?\DateTimeInterface
    {
        return $this->insExp;
    }

    public function setInsExp(\DateTimeInterface $insExp): self
    {
        $this->insExp = $insExp;

        return $this;
    }

    public function getNumberVtcCard(): ?string
    {
        return $this->numberVtcCard;
    }

    public function setNumberVtcCard(string $numberVtcCard): self
    {
        $this->numberVtcCard = $numberVtcCard;

        return $this;
    }

    public function getVtcCardExp(): ?\DateTimeInterface
    {
        return $this->vtcCardExp;
    }

    public function setVtcCardExp(\DateTimeInterface $vtcCardExp): self
    {
        $this->vtcCardExp = $vtcCardExp;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getDriver(): Collection
    {
        return $this->driver;
    }

    public function addDriver(User $driver): self
    {
        if (!$this->driver->contains($driver)) {
            $this->driver[] = $driver;
        }

        return $this;
    }

    public function removeDriver(User $driver): self
    {
        $this->driver->removeElement($driver);

        return $this;
    }

    public function getIsAvaliable(): ?bool
    {
        return $this->isAvaliable;
    }

    public function setIsAvaliable(bool $isAvaliable): self
    {
        $this->isAvaliable = $isAvaliable;

        return $this;
    }

    public function getCarteGrise(): ?File
    {
        return $this->carteGrise;
    }

    public function setCarteGrise(?File $carteGrise): self
    {
        $this->carteGrise = $carteGrise;

        return $this;
    }

    public function getVtcCard(): ?File
    {
        return $this->vtcCard;
    }

    public function setVtcCard(?File $vtcCard): self
    {
        $this->vtcCard = $vtcCard;

        return $this;
    }
}
