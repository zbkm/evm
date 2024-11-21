<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

/**
 * Get balance of the given account
 */
class Balance extends BaseOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "31";

    public function execute(): void
    {
        $address = $this->context->stack->pop();
        $this->context->stack->pushHex(
            $this->context->ethereum->getBalance("0x{$address->get()}")
        );
    }

    public function getSpentGas(): int
    {
        // If the accessed address is warm, the dynamic cost is 100. Otherwise the dynamic cost is 2600
        return 100;
    }
}