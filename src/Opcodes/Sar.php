<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Sar extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "1D";

    public function execute(): void
    {
        $shift = $this->context->stack->pop();
        $value = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::sar($shift, $value));
    }
}