<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Modulo addition operation
 *
 * @note All intermediate calculations of this operation are not subject to the 2256 modulo.
 */
class Addmod extends BaseOpcode
{
    protected const OPCODE = "08";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $n = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::addmod($a, $b, $n));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(8)];
    }
}