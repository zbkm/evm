<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 *
 * Integer division operation
 */
class Div extends BaseOpcode
{
    protected const OPCODE = "04";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::div($a, $b));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(5)];
    }
}