<?php

namespace Autoznetwork\Php700Credit\Enums;

use App\Traits\EnumToArray;

enum Bureau: string
{
    use EnumToArray;

    case EQUIIFAX = 'EFX';

    case EXPERIAN = 'XPN';

    case TRANSUNION = 'TU';
}
