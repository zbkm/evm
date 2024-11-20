<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Byte extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "1A";

    public function execute(): void
    {
        $i = $this->context->stack->pop();
        $x = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::byte($i, $x));
    }
}