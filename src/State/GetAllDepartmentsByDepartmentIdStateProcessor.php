<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Output\OutputArrayOnlyDto;
use App\Repository\DepartmentRepository;

class GetAllDepartmentsByDepartmentIdStateProcessor implements ProcessorInterface
{
    public DepartmentRepository $departmentRepository ;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): OutputArrayOnlyDto
    {
        // Handle the state
        $item = new OutputArrayOnlyDto();
        $item->items = $this->departmentRepository->findBy(array(
            'code' => $data->departmentId
        ));
        return $item;
    }
}
