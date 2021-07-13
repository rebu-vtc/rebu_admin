<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AddressLine1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AddressLine2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AddressLine3;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $Codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToOne(targetEntity=Personnel::class, mappedBy="address", cascade={"persist", "remove"})
     */
    private $personnel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    public function setAddressLine1(?string $AddressLine1): self
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    public function setAddressLine2(?string $AddressLine2): self
    {
        $this->AddressLine2 = $AddressLine2;

        return $this;
    }

    public function getAddressLine3(): ?string
    {
        return $this->AddressLine3;
    }

    public function setAddressLine3(?string $AddressLine3): self
    {
        $this->AddressLine3 = $AddressLine3;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->Codepostal;
    }

    public function setCodepostal(int $Codepostal): self
    {
        $this->Codepostal = $Codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(Personnel $personnel): self
    {
        // set the owning side of the relation if necessary
        if ($personnel->getAddress() !== $this) {
            $personnel->setAddress($this);
        }

        $this->personnel = $personnel;

        return $this;
    }
}
