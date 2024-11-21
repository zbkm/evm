<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get execution origination address
 */
class Origin extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "32";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->origin));
    }
}