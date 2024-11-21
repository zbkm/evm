<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Get input data of current environment
 */
class CallDataLoad extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "35";

    public function execute(): void
    {
        $offset = $this->context->stack->pop();

        $this->context->stack->pushHex(
            Hex::from(CodeStringHelper::getPart($this->context->state->calldata, $offset->getInt(), 32))
        );
    }
}