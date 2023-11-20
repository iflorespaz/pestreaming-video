<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\CategoryRepository;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;

class AddDepartmentToCategoryStateProcessor implements ProcessorInterface
{
    public CategoryRepository $categoryRepository;
    public DepartmentRepository $departmentRepository;
    public EntityManagerInterface $em;

    public function __construct(CategoryRepository $categoryRepository,
                                DepartmentRepository $departmentRepository,
                                EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->departmentRepository = $departmentRepository;
        $this->em = $em;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $category   = $this->categoryRepository->find($data->categoryId);
        $department = $this->departmentRepository->find($data->departmentId);
        if (!is_null($category) && !is_null($department)) {
            $category->addDepartment($department);
            $this->em->persist($category);
            $this->em->flush();
        }

    }
}
