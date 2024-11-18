<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class SignExtend extends BaseOpcode
{
    protected const STATIC_GAS = 5;
    protected const OPCODE = "0B";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::signExtend($a, $b));
    }
}