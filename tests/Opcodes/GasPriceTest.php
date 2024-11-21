<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\GasPrice;
use Zbkm\Evm\Utils\Hex;

class GasPriceTest extends BaseOpcodeTestCase
{
    protected string $testedClass = GasPrice::class;
    protected string $opcode = "3A";
    protected int $staticGas = 2;

    protected const GAS_PRICE = "10";

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::GAS_PRICE)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->gasPrice = self::GAS_PRICE;
        return $context;
    }
}
