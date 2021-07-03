<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    private const STATUS_DEACTIVATE = 0;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id",type="integer")
     *
     * @var int
     */
    private $objectId;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="json")
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
     *
     * @var bool
     */
    private $isVerified = false;

    /**
     * @var null|\DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var null|\DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $desactivationAt;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $agreeTerms;

    /**
     * @var null|\DateTimeInterface
     * @ORM\Column(name="agreeTermsValidatedAt", type="datetime", nullable=true)
     */
    private $agreeTermsValidAt;

    /**
     * @var null|int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(type="string", length=45)
     */
    private $type;

    // Avatar à ajouter une fois le système de gestion de fichier sera implémenté.
    public function __construct()
    {
        $this->email = '';
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
        return $this->objectId;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

}
