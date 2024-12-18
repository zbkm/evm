<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Not extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "19";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::not($a));
    }
}