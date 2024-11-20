<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Addmod extends BaseOpcode
{
    protected const STATIC_GAS = 8;
    protected const OPCODE = "08";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $n = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::addmod($a, $b, $n));
    }
}