<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Modulo multiplication operation
 */
class Mulmod extends BaseOpcode
{
    protected const OPCODE = "09";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $mod = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::mulmod($a, $b, $mod));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(8)];
    }
}