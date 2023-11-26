<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TabsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TabsRepository::class)]
#[ApiResource]
class Tabs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $sort = null;

    #[ORM\ManyToOne(inversedBy: 'tabs')]
    private ?TabType $tabType = null;

    #[ORM\ManyToOne(inversedBy: 'tabs')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getTabType(): ?TabType
    {
        return $this->tabType;
    }

    public function setTabType(?TabType $tabType): static
    {
        $this->tabType = $tabType;

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
}
