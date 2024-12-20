<?php
declare(strict_types=1);

namespace Gas;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Gas\ExpGasCalculator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class ExpGasCalculatorTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [Hex::from(0), 0],
            [Hex::from("ff"), 50],
            [Hex::from("ffff"), 100]
        ];
    }

    #[DataProvider("dataProvider")]
    public function testCalculateGas(Hex $exp, int $size)
    {
        $calculator = new ExpGasCalculator($exp);
        $this->assertEquals($size, $calculator->calculateGas());
    }
}
