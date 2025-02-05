<?php

declare(strict_types=1);

namespace ArtisanBuild\FatEnums\TestEnums;

use ArtisanBuild\FatEnums\Traits\HasBackedEnumMethods;

enum UnbackedEnum
{
    use HasBackedEnumMethods;

    case Yes;
    case No;
    case Maybe;
}
