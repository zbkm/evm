<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Signed integer division operation (truncated)
 */
class Sdiv extends BaseOpcode
{
    protected const OPCODE = "05";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::sdiv($a, $b));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(5)];
    }
}