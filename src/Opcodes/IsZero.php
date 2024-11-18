<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class IsZero extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "15";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $result = HexMath::eq($a, Hex::from("0")) ? "1" : "0";

        $this->context->stack->pushHex(Hex::from($result));
    }
}