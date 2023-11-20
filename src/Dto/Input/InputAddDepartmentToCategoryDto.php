<?php

namespace App\Dto\Input;

use App\Dto\Trait\CategoryIdTrait;
use App\Dto\Trait\DepartmentIdTrait;

class InputAddDepartmentToCategoryDto
{
    use DepartmentIdTrait;
    use CategoryIdTrait;
}
