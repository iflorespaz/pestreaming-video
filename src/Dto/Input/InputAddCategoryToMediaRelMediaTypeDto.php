<?php

namespace App\Dto\Input;

use App\Dto\Trait\CategoryIdTrait;
use App\Dto\Trait\MediaIdTrait;
use App\Dto\Trait\MediaTypeIdDtoTrait;

class InputAddCategoryToMediaRelMediaTypeDto
{
    use CategoryIdTrait;
    use MediaIdTrait;
    use MediaTypeIdDtoTrait;
}
