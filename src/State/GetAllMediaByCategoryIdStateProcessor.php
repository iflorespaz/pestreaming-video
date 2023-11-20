<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Output\OutputArrayOnlyDto;
use App\Repository\MediaRepository;

class GetAllMediaByCategoryIdStateProcessor implements ProcessorInterface
{
    public MediaRepository $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): OutputArrayOnlyDto
    {
        $item = new OutputArrayOnlyDto();
        $item->items =  $this->mediaRepository->findByCategoryId($data->categoryId);;
        return $item;
    }
}
