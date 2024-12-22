<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Remove item from stack
 */
class Pop extends BaseOpcode
{
    protected const OPCODE = "50";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->context->stack->pop();
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}