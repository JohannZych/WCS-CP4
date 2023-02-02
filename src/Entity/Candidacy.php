<?php

namespace App\Entity;

use App\Repository\CandidacyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidacyRepository::class)]
class Candidacy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameEntreprise = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?bool $gonnaApply = null;

    #[ORM\Column(nullable: true)]
    private ?bool $apply = null;

    #[ORM\Column(nullable: true)]
    private ?bool $called = null;

    #[ORM\Column(nullable: true)]
    private ?bool $interview = null;

    #[ORM\ManyToOne(inversedBy: 'candidacies')]
    private ?User $userId = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEntreprise(): ?string
    {
        return $this->nameEntreprise;
    }

    public function setNameEntreprise(?string $nameEntreprise): self
    {
        $this->nameEntreprise = $nameEntreprise;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isGonnaApply(): ?bool
    {
        return $this->gonnaApply;
    }

    public function setGonnaApply(?bool $gonnaApply): self
    {
        $this->gonnaApply = $gonnaApply;

        return $this;
    }

    public function isApply(): ?bool
    {
        return $this->apply;
    }

    public function setApply(?bool $apply): self
    {
        $this->apply = $apply;

        return $this;
    }

    public function isCalled(): ?bool
    {
        return $this->called;
    }

    public function setCalled(?bool $called): self
    {
        $this->called = $called;

        return $this;
    }

    public function isInterview(): ?bool
    {
        return $this->interview;
    }

    public function setInterview(?bool $interview): self
    {
        $this->interview = $interview;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
