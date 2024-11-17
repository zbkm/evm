<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use GMP;

class HexMath
{
    public static function exp(Hex $a, Hex $b): Hex
    {
        $result = gmp_pow($a->gmp(), gmp_intval($b->gmp()));
        $result = gmp_mod($result, self::modulo());
        return Hex::from(gmp_strval($result, 16));
    }

    public static function sum(Hex $a, Hex $b): Hex
    {
        $result = gmp_add($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());
        return Hex::from(gmp_strval($result, 16));
    }

    public static function mul(Hex $a, Hex $b): Hex
    {
        $result = gmp_mul($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());

        return Hex::from(gmp_strval($result, 16));
    }

    public static function sub(Hex $a, Hex $b): Hex
    {
        $result = gmp_sub($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());

        return Hex::from(gmp_strval($result, 16));
    }

    public static function div(Hex $a, Hex $b): Hex
    {
        if ($b->get() === "0") {
            return Hex::from(0);
        }

        $sum = gmp_div($a->get(), $b->get());
        return Hex::from(gmp_strval($sum, 16));
    }

    public static function sdiv(Hex $a, Hex $b): Hex
    {
        $two_complement = gmp_pow(2, 255);

        $signedA = gmp_sub(gmp_mod(gmp_add($a->gmp(), $two_complement), self::modulo()), $two_complement);
        $signedB = gmp_sub(gmp_mod(gmp_add($b->gmp(), $two_complement), self::modulo()), $two_complement);
        $result = gmp_cmp($signedB, 0) == 0 ? 0 : gmp_div_q($signedA, $signedB);
        $result = gmp_mod(gmp_add($result, self::modulo()), self::modulo());

        return Hex::from(gmp_strval($result, 16));
    }

    public static function mod(Hex $a, Hex $b): Hex
    {
        if ($b->get() === "0") {
            return Hex::from(0);
        }

        $mod = gmp_mod($a->gmp(), $b->gmp());
        return Hex::from(gmp_strval($mod, 16));
    }

    public static function smod(Hex $a, Hex $b): Hex
    {
        $two_complement = gmp_pow(2, 255);

        $signedA = gmp_sub(gmp_mod(gmp_add($a->gmp(), $two_complement), self::modulo()), $two_complement);
        $signedB = gmp_sub(gmp_mod(gmp_add($b->gmp(), $two_complement), self::modulo()), $two_complement);

        if (gmp_cmp($signedB, 0) == 0) {
            return Hex::from(0);
        }

        $result = gmp_mod($signedA, $signedB);
        if ($result != 0 && gmp_sign($result) !== gmp_sign($signedB)) {
            $result += $signedB;
        }

        $result = gmp_mod(gmp_add($result, self::modulo()), self::modulo());
        return Hex::from(gmp_strval($result, 16));

    }

    protected static function modulo(): GMP
    {
        return gmp_pow(2, 256);
    }
}