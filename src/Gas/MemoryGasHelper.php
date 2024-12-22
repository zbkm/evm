<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * To calculate dynamic gas consumption when expanding memory
 */
class MemoryGasHelper
{
    /**
     * Calculate memory expansion gas cost
     *
     * @param Hex $newSize new memory size
     * @param Hex $currentSize current memory size
     * @return int cas
     */
    public static function getExpansionPrice(Hex $newSize, Hex $currentSize): int
    {
        if (HexMath::eq($currentSize, Hex::from(0))) {
            return self::getMemoryCost($newSize);
        }

        return self::getMemoryCost($newSize) - self::getMemoryCost($currentSize);
    }

    /**
     * Calculate memory storaging gas cost (expansion from 0)
     *
     * @param Hex $size memory size
     * @return int gas
     */
    public static function getMemoryCost(Hex $size): int
    {
        $size = HexMath::sum($size, Hex::from(1));
        $memorySizeWord = HexMath::sdiv(HexMath::sum($size, Hex::from("1f" /* 31 dec */)), Hex::from("20"));
        return HexMath::sum(
            HexMath::sdiv(HexMath::exp($memorySizeWord, Hex::from("2")), Hex::from("200" /* 512 dec */)),
            HexMath::mul($memorySizeWord, Hex::from("3"))
        )->getInt();
    }
}