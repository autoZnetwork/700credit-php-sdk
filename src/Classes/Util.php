<?php

namespace Autoznetwork\Php700Credit\Classes;

use Autoznetwork\Php700Credit\Enums\Bureau;

class Util
{
    public static function formatImplicitBureausToEnums(array $bureaus): array
    {
        return array_map(fn (mixed $bureau) => match (gettype($bureau)) {
            'string' => Bureau::from($bureau),
            default => $bureau,
        }, $bureaus);
    }
}
