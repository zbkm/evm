<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Shl extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "1B";

    public function execute(): void
    {
        $shift = $this->context->stack->pop();
        $value = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::shl($shift, $value));
    }
}