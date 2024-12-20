<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Place 1 byte item on stack
 */
class Push1 extends BaseOpcode
{
    protected const OPCODE = "60";

    public function execute(): void
    {
        $this->context->stack->push($this->element);
    }

    public function getBytesSkip(): int
    {
        return 1;
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}