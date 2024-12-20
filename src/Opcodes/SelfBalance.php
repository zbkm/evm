<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Get balance of currently executing account
 */
class SelfBalance extends BaseOpcode
{
    protected const OPCODE = "47";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            $this->context->ethereum->getBalance($this->context->state->to)
        );
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(5)];
    }
}