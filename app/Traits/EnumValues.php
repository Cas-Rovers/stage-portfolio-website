<?php

namespace App\Traits;

trait EnumValues
{
    /**
     * Returns all the enum cases value's
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }
}
