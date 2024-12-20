<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Signed modulo remainder operation
 */
class Smod extends BaseOpcode
{
    protected const OPCODE = "07";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::smod($a, $b));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(5)];
    }
}