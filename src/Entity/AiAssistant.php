<?php

namespace App\Entity;

use App\Repository\AiAssistantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AiAssistantRepository::class)]
class AiAssistant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $modelVersion = null;

    #[ORM\Column]
    private ?\DateTime $lastTrained = null;

    #[ORM\Column(nullable: true)]
    private ?array $usageStats = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelVersion(): ?string
    {
        return $this->modelVersion;
    }

    public function setModelVersion(string $modelVersion): static
    {
        $this->modelVersion = $modelVersion;

        return $this;
    }

    public function getLastTrained(): ?\DateTime
    {
        return $this->lastTrained;
    }

    public function setLastTrained(\DateTime $lastTrained): static
    {
        $this->lastTrained = $lastTrained;

        return $this;
    }

    public function getUsageStats(): ?array
    {
        return $this->usageStats;
    }

    public function setUsageStats(?array $usageStats): static
    {
        $this->usageStats = $usageStats;

        return $this;
    }
}
