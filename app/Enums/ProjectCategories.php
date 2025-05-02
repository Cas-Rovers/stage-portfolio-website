<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum ProjectCategories: string
{
    use EnumValues;

    case FRONTEND = 'Frontend';
    case BACKEND = 'Backend';
    case FULLSTACK = 'Fullstack';
}
