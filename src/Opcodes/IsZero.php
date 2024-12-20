<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * Is-zero comparison
 */
class IsZero extends BaseOpcode
{
    protected const OPCODE = "15";

    public function execute(): void
    {
        $a = $this->context->stack->pop();
        $result = HexMath::eq($a, Hex::from("0")) ? "1" : "0";

        $this->context->stack->pushHex(Hex::from($result));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}