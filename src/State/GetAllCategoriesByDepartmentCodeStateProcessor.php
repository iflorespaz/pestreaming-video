<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Output\OutputArrayOnlyDto;
use App\Repository\CategoryRepository;
use App\Repository\DepartmentRepository;

class GetAllCategoriesByDepartmentCodeStateProcessor implements ProcessorInterface
{
    public CategoryRepository $categoryRepository;
    public DepartmentRepository $departmentRepository;
    public function __construct(CategoryRepository $categoryRepository, DepartmentRepository $departmentRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->departmentRepository = $departmentRepository;
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): OutputArrayOnlyDto
    {
        $item = new OutputArrayOnlyDto();
        $item->items = $this->categoryRepository->findByDepartmentCode($data->departmentCode);
        return $item;
    }
}
