<?php

namespace Autoznetwork\Php700Credit\Enums;

enum EmploymentStatus: string
{
    case EMPLOYED = 'Employed';

    case UNEMPLOYED = 'Unemployed';

    case SELF_EMPLOYED = 'Self-Employed';

    case RETIRED = 'Retired';

    case OTHER = 'Other';
}
