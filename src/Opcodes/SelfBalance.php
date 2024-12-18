<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

/**
 * Get balance of currently executing account
 */
class SelfBalance extends BaseOpcode
{
    protected const STATIC_GAS = 5;
    protected const OPCODE = "47";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            $this->context->ethereum->getBalance($this->context->state->to)
        );
    }
}