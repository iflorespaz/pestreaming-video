<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Input\InputAddCategoryToMediaRelMediaTypeDto;
use App\Dto\Input\InputCategoryIdDto;
use App\Dto\Output\OutputArrayOnlyDto;
use App\Repository\MediaRepository;
use App\State\AddCategoryToMediaRelMediaTypeStateProcessor;
use App\State\GetAllMediaByCategoryIdStateProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\OpenApi\Model;
use App\Controller\CreateMediaObjectActionController;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[Post(
    uriTemplate: '/media/GetAllMediaByCategoryId',
    status: 200,
    openapiContext: [
        'summary' => 'Retrieves all media resources by category ID',
        'description' => 'Find all media resources by category ID',
        'responses' => [
            '200' => [
                'description' => 'GetAllMediaByCategoryIdStateProcessor resources'
            ]
        ],
    ],
    normalizationContext: [
        'skip_null_values' => false
    ],
    input: InputCategoryIdDto::class,
    output: OutputArrayOnlyDto::class,
    read: false,
    processor: GetAllMediaByCategoryIdStateProcessor::class
)]
#[Post(
    uriTemplate: '/media/AddCategoryToMediaRelMediaType',
    status: 200,
    openapiContext: [
        'summary' => 'Add a category to a specific media resource, and set media type ID to media resources',
        'description' => 'Add a category to a specific media resource, and set media type ID to media resource',
        'responses' => [
            '200' => [
                'description' => 'AddCategoryToMediaRelMediaTypeStateProcessor resources'
            ]
        ],
    ],
    normalizationContext: [
        'skip_null_values' => false
    ],
    input: InputAddCategoryToMediaRelMediaTypeDto::class,
    output: OutputArrayOnlyDto::class,
    read: false,
    processor: AddCategoryToMediaRelMediaTypeStateProcessor::class
)]
#[Vich\Uploadable]
#[ApiResource(
    types: ['https://schema.org/Media'],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            controller: CreateMediaObjectActionController::class,
            openapi: new Model\Operation(
                responses: [
                ], requestBody: new Model\RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'name' => [
                                        'type' => 'string',
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                    ],
                                    'url' => [
                                        'type' => 'string',
                                    ],
                                    'status' => [
                                        'type' => 'boolean',
                                    ],
                                    'fileCover' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ],
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ]
                                ]
                            ]
                        ]
                    ])
            )
            ),
            validationContext: ['groups' => ['Default', 'media:create']],
            deserialize: false
        )
    ],
    normalizationContext: ['groups' => ['media:read'], 'skip_null_values' => false]
)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['media:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['media:read'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['media:read'])]
    private ?bool $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[Ignore]
    #[Groups(['media:read'])]
    private ?MediaType $mediaType = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'media')]
    #[Ignore]
    #[Groups(['media:read'])]
    private Collection $category;

    #[ApiProperty(types: ['https://schema.org/url'])]
    #[Groups(['media:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['media:read'])]
    private ?string $description = null;


    #[Vich\UploadableField(mapping: "media_image", fileNameProperty: "filePath")]
    #[Assert\NotNull(groups: ['media:create'])]
    #[ORM\Column(length: 255, nullable: true)]
    public ?string $cover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filePath = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getMediaType(): ?MediaType
    {
        return $this->mediaType;
    }

    public function setMediaType(?MediaType $mediaType): static
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

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

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): static
    {
        $this->filePath = $filePath;

        return $this;
    }
}
