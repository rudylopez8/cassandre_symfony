<?php

namespace App\Entity;

use App\Repository\AuditAssignmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditAssignmentRepository::class)]
class AuditAssignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $roleOnAudit = null;

    #[ORM\ManyToOne(inversedBy: 'auditAssignments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'auditAssignments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Audit $audit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleOnAudit(): ?string
    {
        return $this->roleOnAudit;
    }

    public function setRoleOnAudit(string $roleOnAudit): static
    {
        $this->roleOnAudit = $roleOnAudit;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAudit(): ?Audit
    {
        return $this->audit;
    }

    public function setAudit(?Audit $audit): static
    {
        $this->audit = $audit;

        return $this;
    }
}
