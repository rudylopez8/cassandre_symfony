<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $passwordHash = null;

    #[ORM\Column(length: 64)]
    private ?string $firstName = null;

    #[ORM\Column(length: 64)]
    private ?string $lastName = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $lastLogin = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Role $role = null;

    /**
     * @var Collection<int, AuditAssignment>
     */
    #[ORM\OneToMany(targetEntity: AuditAssignment::class, mappedBy: 'user')]
    private Collection $auditAssignments;

    /**
     * @var Collection<int, AuditReport>
     */
    #[ORM\OneToMany(targetEntity: AuditReport::class, mappedBy: 'validatedBy')]
    private Collection $auditReports;

    /**
     * @var Collection<int, AiAssistantHistory>
     */
    #[ORM\OneToMany(targetEntity: AiAssistantHistory::class, mappedBy: 'user')]
    private Collection $aiAssistantHistories;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Invoice $invoice = null;


    public function __construct()
    {
        $this->auditAssignments = new ArrayCollection();
        $this->auditReports = new ArrayCollection();
        $this->aiAssistantHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): static
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTime $lastLogin): static
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, AuditAssignment>
     */
    public function getAuditAssignments(): Collection
    {
        return $this->auditAssignments;
    }

    public function addAuditAssignment(AuditAssignment $auditAssignment): static
    {
        if (!$this->auditAssignments->contains($auditAssignment)) {
            $this->auditAssignments->add($auditAssignment);
            $auditAssignment->setUser($this);
        }

        return $this;
    }

    public function removeAuditAssignment(AuditAssignment $auditAssignment): static
    {
        if ($this->auditAssignments->removeElement($auditAssignment)) {
            // set the owning side to null (unless already changed)
            if ($auditAssignment->getUser() === $this) {
                $auditAssignment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AuditReport>
     */
    public function getAuditReports(): Collection
    {
        return $this->auditReports;
    }

    public function addAuditReport(AuditReport $auditReport): static
    {
        if (!$this->auditReports->contains($auditReport)) {
            $this->auditReports->add($auditReport);
            $auditReport->setValidatedBy($this);
        }

        return $this;
    }

    public function removeAuditReport(AuditReport $auditReport): static
    {
        if ($this->auditReports->removeElement($auditReport)) {
            // set the owning side to null (unless already changed)
            if ($auditReport->getValidatedBy() === $this) {
                $auditReport->setValidatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AiAssistantHistory>
     */
    public function getAiAssistantHistories(): Collection
    {
        return $this->aiAssistantHistories;
    }

    public function addAiAssistantHistory(AiAssistantHistory $aiAssistantHistory): static
    {
        if (!$this->aiAssistantHistories->contains($aiAssistantHistory)) {
            $this->aiAssistantHistories->add($aiAssistantHistory);
            $aiAssistantHistory->setUser($this);
        }

        return $this;
    }

    public function removeAiAssistantHistory(AiAssistantHistory $aiAssistantHistory): static
    {
        if ($this->aiAssistantHistories->removeElement($aiAssistantHistory)) {
            // set the owning side to null (unless already changed)
            if ($aiAssistantHistory->getUser() === $this) {
                $aiAssistantHistory->setUser(null);
            }
        }

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): static
    {
        // unset the owning side of the relation if necessary
        if ($invoice === null && $this->invoice !== null) {
            $this->invoice->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($invoice !== null && $invoice->getUser() !== $this) {
            $invoice->setUser($this);
        }

        $this->invoice = $invoice;

        return $this;
    }

}
