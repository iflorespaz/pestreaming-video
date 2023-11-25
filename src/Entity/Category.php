<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Dto\Input\InputAddDepartmentToCategoryDto;
use App\Dto\Input\InputDepartmentCodeDto;
use App\Dto\Output\OutputArrayOnlyDto;
use App\Repository\CategoryRepository;
use App\State\AddDepartmentToCategoryStateProcessor;
use App\State\GetAllCategoriesByDepartmentCodeStateProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Post(
    uriTemplate: '/categories/GetAllCategoriesByDepartmentCode',
    status: 200,
    openapiContext: [
        'summary' => 'Retrieves all categories by tempest department code',
        'description' => 'Find all categories by tempest department code',
        'responses' => [
            '200' => [
                'description' => 'GetAllCategoriesByDepartmentCodeStateProcessor resources'
            ]
        ],
    ],
    normalizationContext: [
        'skip_null_values' => false
    ],
    input: InputDepartmentCodeDto::class,
    output: OutputArrayOnlyDto::class,
    read: false,
    processor: GetAllCategoriesByDepartmentCodeStateProcessor::class
)]
#[Post(
    uriTemplate: '/categories/AddDepartmentToCategory',
    status: 200,
    openapiContext: [
        'summary' => 'Add a department to a specific category',
        'description' => 'Add a department to a specific category',
        'responses' => [
            '200' => [
                'description' => 'AddDepartmentToCategoryStateProcessor resources'
            ]
        ],
    ],
    normalizationContext: [
        'skip_null_values' => false
    ],
    input: InputAddDepartmentToCategoryDto::class,
    output: OutputArrayOnlyDto::class,
    read: false,
    processor: AddDepartmentToCategoryStateProcessor::class
)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToMany(targetEntity: Department::class, mappedBy: 'category')]
    #[Ignore]
    private Collection $departments;

    #[ORM\ManyToMany(targetEntity: Media::class, mappedBy: 'category')]
    private Collection $media;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
        $this->media = new ArrayCollection();
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
     * @return Collection<int, Department>
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): static
    {
        if (!$this->departments->contains($department)) {
            $this->departments->add($department);
            $department->addCategory($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): static
    {
        if ($this->departments->removeElement($department)) {
            $department->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->addCategory($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            $medium->removeCategory($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }
}
