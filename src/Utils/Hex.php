<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use GMP;
use InvalidArgumentException;

class Hex
{
    const MAX_VALUE = "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

    protected GMP $value;

    public function __construct(string $value)
    {
        $hexValue = gmp_init($value, 16);

        if (gmp_cmp($hexValue, self::MAX_VALUE) > 0 || gmp_cmp(0, $hexValue) > 0) {
            throw new InvalidArgumentException("value > max uint256 or 0 > value");
        }

        $this->value = $hexValue;
    }

    public static function from(string|GMP|int $value): Hex
    {
        switch (gettype($value)) {
            case "integer":
            case "object":
                $value = gmp_strval($value, 16);
                break;
        }

        return new self($value);
    }

    public function gmp(): GMP
    {
        return $this->value;
    }

    public function get(): string
    {
        return gmp_strval($this->value, 16);
    }

    public function getHex(): string
    {
        return "0x" . $this->get();
    }

    public function __toString(): string
    {
        return $this->get();
    }
}