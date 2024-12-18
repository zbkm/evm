<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get the base fee
 */
class BaseFee extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "48";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->baseFee));
    }
}