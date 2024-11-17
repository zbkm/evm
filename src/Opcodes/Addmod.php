<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Addmod extends BaseOpcode
{
    protected const STATIC_GAS = 8;

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::sum($a, $b));

        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::mod($a, $b));
    }

    static public function getOpcode(): string
    {
        return "08";
    }
}