<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\GasLimit;
use Zbkm\Evm\Utils\Hex;

class GasLimitTest extends BaseOpcodeTestCase
{
    protected string $testedClass = GasLimit::class;
    protected string $opcode = "45";
    protected int $staticGas = 2;

    protected const GAS_LIMIT = 500_000;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::GAS_LIMIT)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->gasLimit = self::GAS_LIMIT;
        return $context;
    }
}
