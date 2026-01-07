<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[Assert\Length(
        min: 6,                     // "plus de 5 caractères" → au moins 6
        minMessage: "Le nom doit contenir au moins {min} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 127)]
    #[Assert\NotBlank(message: "L'adresse e‑mail ne peut pas être vide.")]
    #[Assert\Email(
        message: "Ce n'est pas une adresse e‑mail valide."
    )]
    private ?string $mail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }
}
