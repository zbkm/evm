<?php
declare(strict_types=1);

namespace Gas;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Gas\StaticGasCalculator;

class StaticGasCalculatorTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [1, 1],
            [5, 5],
            [100, 100]
        ];
    }

    #[DataProvider("dataProvider")]
    public function testCalculateGas(int $value, int $result)
    {
        $calculator = new StaticGasCalculator($value);
        $this->assertEquals($result, $calculator->calculateGas());
    }
}
