<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get execution origination address
 */
class Origin extends BaseOpcode
{
    protected const OPCODE = "32";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->origin));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}