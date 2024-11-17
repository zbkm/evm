<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Sub extends BaseOpcode
{
    protected const STATIC_GAS = 3;

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::sub($a, $b));
    }

    static public function getOpcode(): string
    {
        return "03";
    }
}