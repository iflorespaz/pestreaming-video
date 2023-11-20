<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use App\Repository\MediaTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class AddCategoryToMediaRelMediaTypeStateProcessor implements ProcessorInterface
{
    public EntityManagerInterface $em;
    public CategoryRepository $categoryRepository;
    public MediaRepository $mediaRepository;
    public MediaTypeRepository $mediaTypeRepository;
    public function __construct(EntityManagerInterface $em,
                                CategoryRepository $categoryRepository,
                                MediaRepository $mediaRepository,
                                MediaTypeRepository $mediaTypeRepository)
    {
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
        $this->mediaRepository = $mediaRepository;
        $this->mediaTypeRepository = $mediaTypeRepository;
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $category = $this->categoryRepository->find($data->categoryId);
        $media = $this->mediaRepository->find($data->mediaId);
        $mediaType = $this->mediaTypeRepository->find($data->mediaTypeId);
        if (!is_null($mediaType)) {
            $media->setMediaType($mediaType);
            $this->em->persist($media);
            $this->em->flush();
        }
        if (!is_null($category) && !is_null($media)) {
            $category->addMedium($media);
            $this->em->persist($category);
            $this->em->flush();


        }
    }
}
