<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Get size of input data in current environment
 */
class CallDataSize extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "36";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            Hex::from(CodeStringHelper::getSize($this->context->state->calldata))
        );
    }
}