<?php

namespace App\Entity;

enum License: string
{
    case AFL_3_0 = 'AFL-3.0';
    case ALL_RIGHTS_RESERVED = 'AllRightsReserved';
    case APACHE_2_0 = 'Apache-2.0';
    case ARTISTIC_2_0 = 'Artistic-2.0';
    case BSL_1_0 = 'BSL-1.0';
    case BSD_2_CLAUSE = 'BSD-2-Clause';
    case BSD_3_CLAUSE = 'BSD-3-Clause';
    case BSD_3_CLAUSE_CLEAR = 'BSD-3-Clause-Clear';
    case BSD_4_CLAUSE = 'BSD-4-Clause';
    case ZERO_BSD = '0BSD';
    case CC = 'CC';
    case CC0_1_0 = 'CC0-1.0';
    case CC_BY_4_0 = 'CC-BY-4.0';
    case CC_BY_SA_4_0 = 'CC-BY-SA-4.0';
    case WTFPL = 'WTFPL';
    case ECL_2_0 = 'ECL-2.0';
    case EPL_1_0 = 'EPL-1.0';
    case EPL_2_0 = 'EPL-2.0';
    case EUPL_1_1 = 'EUPL-1.1';
    case AGPL_3_0 = 'AGPL-3.0';
    case GPL = 'GPL';
    case GPL_2_0 = 'GPL-2.0';
    case GPL_3_0 = 'GPL-3.0';
    case LGPL = 'LGPL';
    case LGPL_2_1 = 'LGPL-2.1';
    case LGPL_3_0 = 'LGPL-3.0';
    case ISC = 'ISC';
    case LPPL_1_3C = 'LPPL-1.3c';
    case MS_PL = 'MS-PL';
    case MIT = 'MIT';
    case MPL_2_0 = 'MPL-2.0';
    case OSL_3_0 = 'OSL-3.0';
    case POSTGRESQL = 'PostgreSQL';
    case OFL_1_1 = 'OFL-1.1';
    case NCSA = 'NCSA';
    case UNLICENSE = 'Unlicense';
    case ZLIB = 'Zlib';

    public static function default(): self {
        return self::ALL_RIGHTS_RESERVED;
    }
}

