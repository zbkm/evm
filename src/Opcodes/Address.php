<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get address of currently executing account
 */
class Address extends BaseOpcode
{
    protected const OPCODE = "30";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->to));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}