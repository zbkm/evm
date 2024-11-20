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
            [3, Hex::from("0")],
            [6, Hex::from("20")],
            [6809, Hex::from("9C40")]
        ];
    }

    #[DataProvider("memoryCostProvider")]
    public function testGetMemoryCost(int $result, Hex $size): void
    {
        $this->assertSame($result, MemoryGasHelper::getMemoryCost($size));
    }

    public static function expansionProvider(): array
    {
        return [
//            [3, Hex::from("0"), Hex::from("0")],
            [6, Hex::from("20"), Hex::from("0")],
            [6, Hex::from("40"), Hex::from("20")],
            [9, Hex::from("40"), Hex::from("0")],
            [0, Hex::from("0"), Hex::from("20")],
            [6806, Hex::from("9C40"), Hex::from("20")],
        ];
    }

    #[DataProvider("expansionProvider")]
    public function testGetExpansionPrice(int $result, Hex $newSize, Hex $currentSize): void
    {
        $this->assertSame($result, MemoryGasHelper::getExpansionPrice($newSize, $currentSize));
    }
}
