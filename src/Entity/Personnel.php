<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PersonnelRepository::class)
 */
class Personnel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="date", nullable=true)
     */
    private $dob;

    /**
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="text", nullable=true)
     */
    private $facebookToken;

    /**
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idNumber;

    /**
     * @ORM\OneToOne(targetEntity=File::class, cascade={"persist", "remove"})
     */
    private $idCard;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="personnel", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getFacebookToken(): ?string
    {
        return $this->facebookToken;
    }

    public function setFacebookToken(?string $facebookToken): self
    {
        $this->facebookToken = $facebookToken;

        return $this;
    }

    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    public function setIdNumber(?string $idNumber): self
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    public function getIdCard(): ?File
    {
        return $this->idCard;
    }

    public function setIdCard(?File $idCard): self
    {
        $this->idCard = $idCard;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setPersonnel(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getPersonnel() !== $this) {
            $user->setPersonnel($this);
        }

        $this->user = $user;

        return $this;
    }
}
