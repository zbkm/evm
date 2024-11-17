<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Div extends BaseOpcode
{
    protected const STATIC_GAS = 5;

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::div($a, $b));
    }

    static public function getOpcode(): string
    {
        return "04";
    }
}