<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Opcodes\BaseOpcode;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class Sgt extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "13";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $signA = HexMath::toSigned($a);
        $signB = HexMath::toSigned($b);
        $result = HexMath::cmp($signA, $signB) > 0 ? "1" : "0";

        $this->context->stack->pushHex(Hex::from($result));
    }
}