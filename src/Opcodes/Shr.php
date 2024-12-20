<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Logical right shift operation
 */
class Shr extends BaseOpcode
{
    protected const OPCODE = "1C";

    public function execute(): void
    {
        $shift = $this->context->stack->pop();
        $value = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::shr($shift, $value));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}