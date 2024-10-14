<?php

namespace Autoznetwork\Php700Credit\Enums;

enum ProductType: string
{
    case CREDIT = 'CREDIT';

    case OFAC = 'OFAC';

    case OFACB = 'OFACB';

    case ID_CHECK = 'IDCHECK';

    case RED_FLAG = 'REDFLAG';

    case PRE_SCREEN = 'PRESCREEN';

    case PRE_QUALIFY = 'PREQUALIFY';

    case SAVE_ONLY = 'SAVEONLY';
}
