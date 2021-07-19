<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class User implements UserInterface
{
    private const STATUS_DEACTIVATE = 0;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id",type="integer")
     * @Groups("user:read", "user:write")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user:read", "user:write")
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user:read", "user:write")
     *
     * @var array
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read", "user:write")
     *
     * @var bool
     */
    private $isVerified = false;

    /**
     * @var null|\DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("user:read", "user:write")
     */
    private $createdAt;

    /**
     * @var null|\DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("user:read", "user:write")
     */
    private $desactivationAt;

    /**
     * @var bool
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="boolean")
     */
    private $agreeTerms;

    /**
     * @var null|\DateTimeInterface
     * @Groups("user:read", "user:write")
     * @ORM\Column(name="agreeTermsValidatedAt", type="datetime", nullable=true)
     */
    private $agreeTermsValidAt;

    /**
     * @var null|int
     * @Groups("user:read", "user:write")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=Personnel::class, inversedBy="user", cascade={"persist", "remove"})
     * @Groups("user:read", "user:write")
     */
    private $personnel;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="createdBy")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity=Vehicle::class, mappedBy="driver")
     */
    private $vehicles;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="users")
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity=Trip::class, mappedBy="driver")
     */
    private $trips;

    // Avatar à ajouter une fois le système de gestion de fichier sera implémenté.
    public function __construct()
    {
        $this->email = '';
        $this->messages = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
        $this->trips = new ArrayCollection();
    }

    /**
     * Create user.
     *
     * @ORM\PrePersist
     */
    public function createUser(): void
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new DateTime('now');
        }
        if (!empty($this->agreeTerms)) {
            $this->agreeTermsValidAt = new DateTime('now');
        }
    }

    /**
     * Active user if isVerified = true.
     *
     * status NULL = non définit
     * status 0 = DEACTIVATE
     * status 1 = active
     * status ... = ...
     *
     * @ORM\PreUpdate
     */
    public function activeOrDesactivateUser(): void
    {
        if (null !== $this->status) {
            if (self::STATUS_DEACTIVATE === $this->status) {
                $this->desactivationAt = new DateTime('now');
            }
            if ($this->status > self::STATUS_DEACTIVATE) {
                $this->desactivationAt = null;
            }
        }
        if (empty($this->status) && !empty($this->isVerified)) {
            $this->status = 1;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getFullName(): string
    {
        $userInfo = $this->personnel;
        $name = '';
        if ($userInfo) {
            $firstName = $userInfo->getFirstName();
            $lastName = $userInfo->getLastName();
        
            if ($lastName) {
                $name = $lastName;
            }
            if ($firstName) {
                $name = ($name) ? $lastName . ' ' .$firstName : $firstName;
            }
        }

        return $name;
    } 

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; //Guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDesactivationAt(): ?\DateTimeInterface
    {
        return $this->desactivationAt;
    }

    public function setDesactivationAt(?\DateTimeInterface $desactivationAt): self
    {
        $this->desactivationAt = $desactivationAt;

        return $this;
    }

    public function getAgreeTerms(): ?bool
    {
        return $this->agreeTerms;
    }

    public function setAgreeTerms(bool $agreeTerms): self
    {
        $this->agreeTerms = $agreeTerms;

        return $this;
    }

    public function getagreeTermsValidAt(): ?\DateTimeInterface
    {
        return $this->agreeTermsValidAt;
    }

    public function setagreeTermsValidAt(?\DateTimeInterface $agreeTermsValidAt): self
    {
        $this->agreeTermsValidAt = $agreeTermsValidAt;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setCreatedBy($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCreatedBy() === $this) {
                $message->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->addDriver($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->removeElement($vehicle)) {
            $vehicle->removeDriver($this);
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Trip[]
     */
    public function getTrips(): Collection
    {
        return $this->trips;
    }

    public function addTrip(Trip $trip): self
    {
        if (!$this->trips->contains($trip)) {
            $this->trips[] = $trip;
            $trip->setDriver($this);
        }

        return $this;
    }

    public function removeTrip(Trip $trip): self
    {
        if ($this->trips->removeElement($trip)) {
            // set the owning side to null (unless already changed)
            if ($trip->getDriver() === $this) {
                $trip->setDriver(null);
            }
        }

        return $this;
    }

}
