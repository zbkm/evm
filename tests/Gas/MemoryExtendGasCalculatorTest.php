<?php
declare(strict_types=1);

namespace Gas;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class MemoryExtendGasCalculatorTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [Hex::from(0), Hex::from(0), 3],
            [Hex::from(32), Hex::from(32), 0],
            [Hex::from(32), Hex::from(64), 3],
            [Hex::from(32), Hex::from(32), 0],
        ];
    }

    #[DataProvider("dataProvider")]
    public function testCalculateGas(Hex $initialMemorySize, Hex $memorySize, int $result): void
    {
        $calculator = new MemoryExtendGasCalculator($initialMemorySize, $memorySize);
        $this->assertEquals($result, $calculator->calculateGas());
    }
}
