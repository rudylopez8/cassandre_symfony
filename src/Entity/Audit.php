<?php

namespace App\Entity;

use App\Repository\AuditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditRepository::class)]
class Audit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $endDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scope = null;

    #[ORM\Column(length: 511, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'audits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    /**
     * @var Collection<int, AuditAssignment>
     */
    #[ORM\OneToMany(targetEntity: AuditAssignment::class, mappedBy: 'audit')]
    private Collection $auditAssignments;

    /**
     * @var Collection<int, AuditLegalDocument>
     */
    #[ORM\OneToMany(targetEntity: AuditLegalDocument::class, mappedBy: 'audit')]
    private Collection $auditLegalDocuments;

    #[ORM\OneToOne(mappedBy: 'audit', cascade: ['persist', 'remove'])]
    private ?AuditReport $auditReport = null;

    /**
     * @var Collection<int, Invoice>
     */
    #[ORM\OneToMany(targetEntity: Invoice::class, mappedBy: 'audit')]
    private Collection $invoices;

    public function __construct()
    {
        $this->auditAssignments = new ArrayCollection();
        $this->auditLegalDocuments = new ArrayCollection();
        $this->invoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(?string $scope): static
    {
        $this->scope = $scope;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

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
            $auditAssignment->setAudit($this);
        }

        return $this;
    }

    public function removeAuditAssignment(AuditAssignment $auditAssignment): static
    {
        if ($this->auditAssignments->removeElement($auditAssignment)) {
            // set the owning side to null (unless already changed)
            if ($auditAssignment->getAudit() === $this) {
                $auditAssignment->setAudit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AuditLegalDocument>
     */
    public function getAuditLegalDocuments(): Collection
    {
        return $this->auditLegalDocuments;
    }

    public function addAuditLegalDocument(AuditLegalDocument $auditLegalDocument): static
    {
        if (!$this->auditLegalDocuments->contains($auditLegalDocument)) {
            $this->auditLegalDocuments->add($auditLegalDocument);
            $auditLegalDocument->setAudit($this);
        }

        return $this;
    }

    public function removeAuditLegalDocument(AuditLegalDocument $auditLegalDocument): static
    {
        if ($this->auditLegalDocuments->removeElement($auditLegalDocument)) {
            // set the owning side to null (unless already changed)
            if ($auditLegalDocument->getAudit() === $this) {
                $auditLegalDocument->setAudit(null);
            }
        }

        return $this;
    }

    public function getAuditReport(): ?AuditReport
    {
        return $this->auditReport;
    }

    public function setAuditReport(AuditReport $auditReport): static
    {
        // set the owning side of the relation if necessary
        if ($auditReport->getAudit() !== $this) {
            $auditReport->setAudit($this);
        }

        $this->auditReport = $auditReport;

        return $this;
    }

    /**
     * @return Collection<int, Invoice>
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): static
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices->add($invoice);
            $invoice->setAudit($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): static
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getAudit() === $this) {
                $invoice->setAudit(null);
            }
        }

        return $this;
    }
}
