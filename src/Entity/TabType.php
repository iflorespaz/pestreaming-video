<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TabTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: TabTypeRepository::class)]
class TabType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $code = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'tabType', targetEntity: Tabs::class)]
    private Collection $tabs;

    public function __construct()
    {
        $this->tabs = new ArrayCollection();
    }

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Tabs>
     */
    public function getTabs(): Collection
    {
        return $this->tabs;
    }

    public function addTab(Tabs $tab): static
    {
        if (!$this->tabs->contains($tab)) {
            $this->tabs->add($tab);
            $tab->setTabType($this);
        }

        return $this;
    }

    public function removeTab(Tabs $tab): static
    {
        if ($this->tabs->removeElement($tab)) {
            // set the owning side to null (unless already changed)
            if ($tab->getTabType() === $this) {
                $tab->setTabType(null);
            }
        }

        return $this;
    }
}
