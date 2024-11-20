<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Shr extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "1C";

    public function execute(): void
    {
        $shift = $this->context->stack->pop();
        $value = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::shr($shift, $value));
    }
}