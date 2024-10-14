<?php

namespace Autoznetwork\Php700Credit\Enums;

enum HousingType: string
{
    case RENT = 'Rent';

    case OWN = 'Own';

    case OWN_FREE_AND_CLEAR = 'Own_Freeandclear';

    case OTHER = 'Other';
}
