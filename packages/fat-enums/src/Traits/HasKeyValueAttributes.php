<?php

declare(strict_types=1);

namespace ArtisanBuild\FatEnums\Traits;

use ArtisanBuild\FatEnums\Attributes\WithData;
use BackedEnum;
use ReflectionClassConstant;
use UnitEnum;

trait HasKeyValueAttributes
{
    public function data(BackedEnum|UnitEnum $enum, ?string $key = null): mixed
    {
        $data = (new ReflectionClassConstant($enum::class, $enum->name))
            ->getAttributes(WithData::class)[0]->newInstance()->data;

        if (null === $key) {
            return $data;
        }

        return data_get($data, $key);
    }
}
