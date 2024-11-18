<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class Lt extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "10";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $result = HexMath::cmp($a, $b) > 0 ? "0" : "1";

        $this->context->stack->pushHex(Hex::from($result));
    }
}