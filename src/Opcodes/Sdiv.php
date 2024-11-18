<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\HexMath;

class Sdiv extends BaseOpcode
{
    protected const STATIC_GAS = 5;
    protected const OPCODE = "05";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();

        $this->context->stack->pushHex(HexMath::sdiv($a, $b));
    }
}