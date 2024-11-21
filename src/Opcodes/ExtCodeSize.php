<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Get size of an account’s code
 */
class ExtCodeSize extends BaseOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "3B";

    public function execute(): void
    {
        $address = $this->context->stack->pop();
        $this->context->stack->pushHex(
            Hex::from(
                CodeStringHelper::getSize(
                    $this->context->ethereum->getCode("0x{$address->get()}")
                )
            )
        );
    }

    public function getSpentGas(): int
    {
        // If the accessed address is warm, the dynamic cost is 100. Otherwise the dynamic cost is 2600
        return 100;
    }
}