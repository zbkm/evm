<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

class HexMath
{

    public static function sum(Hex $one, Hex $two): Hex
    {
        $sum = gmp_add($one->get(), $two->get());
        $modulo = gmp_pow(2, 256);
        $sum = gmp_mod($sum, $modulo);

        return Hex::from(gmp_strval($sum, 16));
    }
}