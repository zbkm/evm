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
            [3, 0],
            [6, 32],
            [6809, 40000]
        ];
    }

    #[DataProvider("memoryCostProvider")]
    public function testGetMemoryCost(int $result, int $size): void
    {
        $this->assertSame($result, MemoryGasHelper::getMemoryCost(Hex::from($size)));
    }

    public static function expansionProvider(): array
    {
        return [
//            [3, Hex::from("0"), Hex::from("0")],
            [6, 32, 0],
            [6, 64, 32],
            [9, 64, 0],
            [0, 0, 32],
            [6806, 40000, 32],
        ];
    }

    #[DataProvider("expansionProvider")]
    public function testGetExpansionPrice(int $result, int $newSize, int $currentSize): void
    {
        $this->assertSame($result, MemoryGasHelper::getExpansionPrice(Hex::from($newSize), Hex::from($currentSize)));
    }
}
