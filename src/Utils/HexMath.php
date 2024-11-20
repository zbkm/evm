<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use GMP;

class HexMath
{
    /**
     * Arithmetic (signed) right shift operation
     *
     * Shift the bits towards the least significant one. The bits moved before the first one are discarded, the new bits are set to 0 if the previous most significant bit was 0, otherwise the new bits are set to 1
     *
     * @param Hex $shift number of bits to shift to the right
     * @param Hex $value 32 integer to shift
     * @return Hex value >> shift: the shifted value
     */
    public static function sar(Hex $shift, Hex $value): Hex
    {
        if (gmp_cmp($shift->gmp(), 255) > 0) {
            return Hex::from("0");
        }

        $result = $value->gmp() >> $shift->gmp();
        if (0 > gmp_cmp(HexMath::toSigned($value)->gmp(), 0)) {
            $mask = gmp_sub(self::modulo(), gmp_pow(2, 256 - $shift->getInt()));
            $result = gmp_or($result, $mask);
        }

        return Hex::from(gmp_strval($result, 16));
    }


    /**
     * Logical right shift operation
     *
     * Shift the bits towards the least significant one. The bits moved before the first one are discarded, the new bits are set to 0
     *
     * @param Hex $num   number of bits to shift to the right
     * @param Hex $value 32 bytes to shift
     * @return Hex value >> shift: the shifted value. If shift is bigger than 255, returns 0
     */
    public static function shr(Hex $num, Hex $value): Hex
    {
        if (gmp_cmp($num->gmp(), 255) > 0) {
            return Hex::from("0");
        }

        $result = $value->gmp() >> $num->gmp();
        $result = gmp_and($result, gmp_sub(self::modulo(), 1));

        return Hex::from($result);
    }

    /**
     * Left shift operation
     *
     * Shift the bits towards the most significant one. The bits moved after the 256th one are discarded, the new bits are set to 0
     *
     * @param Hex $shift number of bits to shift to the left
     * @param Hex $value 32 bytes to shift
     * @return Hex value << shift: the shifted value. If shift is bigger than 255, returns 0
     */
    public static function shl(Hex $shift, Hex $value): Hex
    {
        if (gmp_cmp($shift->gmp(), 255) > 0) {
            return Hex::from("0");
        }

        $result = $value->gmp() << $shift->gmp();
        $result = gmp_and($result, gmp_sub(self::modulo(), 1));

        return Hex::from($result);
    }

    /**
     * Retrieve single byte from word
     *
     * @param Hex $i     byte offset starting from the most significant byte
     * @param Hex $value 32-byte value
     * @return Hex the indicated byte at the least significant position. If the byte offset is out of range, the result is 0
     */
    public static function byte(Hex $i, Hex $value): Hex
    {
        $index = gmp_intval($i->gmp());

        if ($index < 0 || $index >= 32) {
            return Hex::from("0");
        }

        $shifted = gmp_div_q($value->gmp(), gmp_pow(2, (31 - $index) * 8));
        $byte = gmp_and($shifted, "0xFF");

        return Hex::from($byte);
    }

    /**
     * Bitwise NOT operation
     *
     * @param Hex $value value
     * @return Hex bitwise NOT result
     */
    public static function not(Hex $value): Hex
    {
        $result = ~$value->gmp();
        $result = gmp_mod($result, self::modulo());

        return Hex::from($result);
    }

    /**
     * Bitwise XOR operation
     *
     * @param Hex $a first value
     * @param Hex $b second value
     * @return Hex bitwise XOR result
     */
    public static function xor(Hex $a, Hex $b): Hex
    {
        return Hex::from(gmp_xor($a->gmp(), $b->gmp()));
    }

    /**
     * Bitwise OR operation
     *
     * @param Hex $a first value
     * @param Hex $b second value
     * @return Hex bitwise OR result
     */
    public static function or(Hex $a, Hex $b): Hex
    {
        return Hex::from(gmp_or($a->gmp(), $b->gmp()));
    }

    /**
     * Bitwise AND operation
     *
     * @param Hex $a first value
     * @param Hex $b second value
     * @return Hex bitwise AND result
     */
    public static function and(Hex $a, Hex $b): Hex
    {
        return Hex::from(gmp_and($a->gmp(), $b->gmp()));
    }

    /**
     * Equality comparison
     *
     * @param Hex $a first
     * @param Hex $b second
     * @return bool a == 0: 1 if a is 0, 0 otherwise
     */
    public static function eq(Hex $a, Hex $b): bool
    {
        return $a->get() === $b->get();
    }

    /**
     * Format to signed value
     *
     * @param Hex $value value
     * @return Hex
     */
    public static function toSigned(Hex $value): Hex
    {
        $two_complement = gmp_pow(2, 255);
        $result =  gmp_sub(gmp_mod(gmp_add($value->gmp(), $two_complement), self::modulo()), $two_complement);

        return Hex::from($result);
    }

    /**
     * Exponential operation
     *
     * @param Hex $a base
     * @param Hex $b exponent
     * @return Hex
     */
    public static function exp(Hex $a, Hex $b): Hex
    {
        $result = gmp_powm($a->gmp(), $b->gmp(), self::modulo());
        return Hex::from($result);
    }

    /**
     * Addition operation
     *
     * @param Hex $a first value to add
     * @param Hex $b second value to add
     * @return Hex
     */
    public static function sum(Hex $a, Hex $b): Hex
    {
        $result = gmp_add($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());
        return Hex::from($result);
    }

    /**
     * Multiplication operation
     *
     * @param Hex $a first value to multiply
     * @param Hex $b second value to multiply
     * @return Hex
     */
    public static function mul(Hex $a, Hex $b): Hex
    {
        $result = gmp_mul($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());

        return Hex::from($result);
    }

    /**
     * Modulo multiplication operation
     * All intermediate calculations of this operation are not subject to the 2^256 modulo
     *
     * @param Hex $a first value to multiply
     * @param Hex $b second value to multiply
     * @param Hex $n integer denominator
     * @return Hex
     */
    public static function mulmod(Hex $a, Hex $b, Hex $n): Hex
    {
        if ($n->get() === "0") {
            return Hex::from(0);
        }

        $result = gmp_mul($a->gmp(), $b->gmp()); // mul
        $result = gmp_mod($result, $n->gmp()); // mod

        return Hex::from($result);
    }

    /**
     * Modulo addition operation
     * All intermediate calculations of this operation are not subject to the 2^256 modulo.
     *
     * @param Hex $a first value to add
     * @param Hex $b second value to add
     * @param Hex $n integer denominator
     * @return Hex
     */
    public static function addmod(Hex $a, Hex $b, Hex $n): Hex
    {
        if ($n->get() === "0") {
            return Hex::from(0);
        }

        $result = gmp_add($a->gmp(), $b->gmp()); // add
        $result = gmp_mod($result, $n->gmp()); // mod

        return Hex::from($result);
    }

    /**
     * Subtraction operation
     *
     * @param Hex $a first value
     * @param Hex $b value to subtract to the first
     * @return Hex
     */
    public static function sub(Hex $a, Hex $b): Hex
    {
        $result = gmp_sub($a->gmp(), $b->gmp());
        $result = gmp_mod($result, self::modulo());

        return Hex::from($result);
    }

    /**
     * Integer division operation
     *
     * @param Hex $a numerator
     * @param Hex $b denominator
     * @return Hex
     */
    public static function div(Hex $a, Hex $b): Hex
    {
        if ($b->get() === "0") {
            return Hex::from(0);
        }

        $sum = gmp_div($a->gmp(), $b->gmp());
        return Hex::from($sum);
    }

    /**
     * Signed integer division operation (truncated)
     *
     * @param Hex $a numerator
     * @param Hex $b denominator
     * @return Hex
     */
    public static function sdiv(Hex $a, Hex $b): Hex
    {
        $two_complement = gmp_pow(2, 255);

        $signedA = gmp_sub(gmp_mod(gmp_add($a->gmp(), $two_complement), self::modulo()), $two_complement);
        $signedB = gmp_sub(gmp_mod(gmp_add($b->gmp(), $two_complement), self::modulo()), $two_complement);
        $result = gmp_cmp($signedB, 0) == 0 ? 0 : gmp_div_q($signedA, $signedB);
        $result = gmp_mod(gmp_add($result, self::modulo()), self::modulo());

        return Hex::from($result);
    }

    /**
     * Modulo remainder operation
     *
     * @param Hex $a numerator
     * @param Hex $b denominator
     * @return Hex
     */
    public static function mod(Hex $a, Hex $b): Hex
    {
        if ($b->get() === "0") {
            return Hex::from(0);
        }

        $mod = gmp_mod($a->gmp(), $b->gmp());
        return Hex::from($mod);
    }

    /**
     * Signed modulo remainder operation
     *
     * @param Hex $a numerator
     * @param Hex $b denominator
     * @return Hex
     */
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
        return Hex::from($result);

    }

    /**
     * Extend length of two’s complement signed integer
     *
     * @param Hex $b size in byte
     * @param Hex $x value to sign extend
     * @return Hex
     */
    public static function signExtend(Hex $b, Hex $x): Hex
    {
        $bitIndex = gmp_add(gmp_mul($b->gmp(), 8), 7);
        if ($bitIndex >= 256) {
            return $x; // if size > 256 bit, return value not edited
        }

        $mask = gmp_sub(gmp_pow(2, gmp_intval($bitIndex + 1)), 1); // mask
        $result = gmp_and($x->gmp(), $mask); // only high-order bits

        if (gmp_testbit($x->gmp(), gmp_intval($bitIndex))) { // if MSb = 1
            $result = gmp_or($result, ~gmp_and($mask, gmp_sub(self::modulo(), 1)));
        }
        $result = gmp_mod(gmp_add($result, self::modulo()), self::modulo());

        return Hex::from($result);
    }

    /**
     * Compare two hex
     *
     * @param Hex $a left side
     * @param Hex $b right side
     * @return int a positive value if a > b, zero if a = b and a negative value if a < b
     */
    public static function cmp(Hex $a, Hex $b): int
    {
        return gmp_cmp($a->gmp(), $b->gmp());
    }

    /**
     * 2 ^ 256
     *
     * @return GMP
     */
    protected static function modulo(): GMP
    {
        return gmp_pow(2, 256);
    }
}