<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Add extends BaseOpcode
{

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::sum($a, $b));
    }

    public function getSpentGas(): int
    {
        return 3;
    }

    static public function getOpcode(): string
    {
        return "01";
    }
}