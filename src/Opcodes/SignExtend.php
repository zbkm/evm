<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Extend length of two’s complement signed integer
 */
class SignExtend extends BaseOpcode
{
    protected const OPCODE = "0B";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::signExtend($a, $b));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(5)];
    }
}