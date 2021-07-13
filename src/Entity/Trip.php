<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $startFrom;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class)
     */
    private $endTo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passanger;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsAccepted;

    /**
     * @ORM\ManyToOne(targetEntity=Rate::class, inversedBy="trips")
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartFrom(): ?Address
    {
        return $this->startFrom;
    }

    public function setStartFrom(?Address $startFrom): self
    {
        $this->startFrom = $startFrom;

        return $this;
    }

    public function getEndTo(): ?Address
    {
        return $this->endTo;
    }

    public function setEndTo(?Address $endTo): self
    {
        $this->endTo = $endTo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDriver(): ?User
    {
        return $this->driver;
    }

    public function setDriver(?User $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getPassanger(): ?user
    {
        return $this->passanger;
    }

    public function setPassanger(?user $passanger): self
    {
        $this->passanger = $passanger;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->IsAccepted;
    }

    public function setIsAccepted(bool $IsAccepted): self
    {
        $this->IsAccepted = $IsAccepted;

        return $this;
    }

    public function getRate(): ?Rate
    {
        return $this->rate;
    }

    public function setRate(?Rate $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
