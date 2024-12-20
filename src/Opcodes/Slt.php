<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * Signed less-than comparison
 */
class Slt extends BaseOpcode
{
    protected const OPCODE = "12";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $b = $this->context->stack->pop();
        $signA = HexMath::toSigned($a);
        $signB = HexMath::toSigned($b);
        $result = HexMath::cmp($signB, $signA) > 0 ? "1" : "0";

        $this->context->stack->pushHex(Hex::from($result));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}