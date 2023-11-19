<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MediaTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaTypeRepository::class)]
#[ApiResource]
class MediaType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\OneToMany(mappedBy: 'mediaType', targetEntity: Media::class)]
    private Collection $trainingMedia;

    public function __construct()
    {
        $this->trainingMedia = new ArrayCollection();
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
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->trainingMedia;
    }

    public function addMedium(Media $trainingMedium): static
    {
        if (!$this->trainingMedia->contains($trainingMedium)) {
            $this->trainingMedia->add($trainingMedium);
            $trainingMedium->setMediaType($this);
        }

        return $this;
    }

    public function removeMedium(Media $trainingMedium): static
    {
        if ($this->trainingMedia->removeElement($trainingMedium)) {
            // set the owning side to null (unless already changed)
            if ($trainingMedium->getMediaType() === $this) {
                $trainingMedium->setMediaType(null);
            }
        }

        return $this;
    }
}
