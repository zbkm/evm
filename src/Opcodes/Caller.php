<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get caller address
 */
class Caller extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "33";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->caller));
    }
}