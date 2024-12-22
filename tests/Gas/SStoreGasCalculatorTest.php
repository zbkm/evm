<?php
declare(strict_types=1);

namespace Gas;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\AccessList;
use Zbkm\Evm\Gas\SStoreGasCalculator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storages\MemoryStorage;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class SStoreGasCalculatorTest extends TestCase
{
    public static function memoryCostProvider(): array
    {
        return [
            [Hex::from(0), Hex::from(0), Hex::from(0), 100, 0],
            [Hex::from(1), Hex::from(0), Hex::from(0), 20000, 0],
            [Hex::from(1), Hex::from(0), Hex::from(1), 100, 2000],
            [Hex::from(1111), Hex::from(1), Hex::from(1111), 100, 2800],
            [Hex::from(0), Hex::from(1), Hex::from(1111), 100, 4800],
            [Hex::from(0), Hex::from(0), Hex::from(1), 100, 0],
        ];
    }

    #[DataProvider("memoryCostProvider")]
    public function test(Hex $input, Hex $currentValue, Hex $originalValue, int $gas, int $refundGas): void
    {
        $slot = Hex::from(0);
        $ac = new AccessList();
        $storage = new MemoryStorage();
        if (!HexMath::eq($originalValue, Hex::from(0))) {
            $storage->set($slot, $originalValue);
            $storage->commit();
        }

        $calculator = new SStoreGasCalculator($storage, $slot, $input, $currentValue);
        $this->assertSame($gas, $calculator->calculateGas());
        $this->assertSame($refundGas, $calculator->calculateRefundGas());
    }
}
