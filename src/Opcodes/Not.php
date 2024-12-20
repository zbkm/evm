<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Bitwise NOT operation
 */
class Not extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "19";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::not($a));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}