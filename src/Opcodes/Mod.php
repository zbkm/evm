<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Mod extends BaseOpcode
{
    protected const STATIC_GAS = 5;
    protected const OPCODE = "06";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::mod($a, $b));
    }
}