<?php
declare(strict_types=1);

namespace Gas;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Gas\MemoryGasHelper;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class MemoryGasHelperTest extends TestCase
{
    public static function memoryCostProvider(): array
    {
        return [
            [0, 3],
            [32, 6],
            [64, 9]
        ];
    }

    #[DataProvider("memoryCostProvider")]
    public function testGetMemoryCost(int $size, int $result): void
    {
        $this->assertSame($result, MemoryGasHelper::getMemoryCost(Hex::from($size)));
    }

    public static function expansionProvider(): array
    {
        return [
            [6, 32, 0],
            [3, 64, 32],
            [9, 64, 0],
            [0, 32, 32]
        ];
    }

    #[DataProvider("expansionProvider")]
    public function testGetExpansionPrice(int $result, int $newSize, int $currentSize): void
    {
        $this->assertSame($result, MemoryGasHelper::getExpansionPrice(Hex::from($newSize), Hex::from($currentSize)));
    }
}
