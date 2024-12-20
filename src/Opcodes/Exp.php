<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\ExpGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * Exponential operation
 */
class Exp extends BaseOpcode
{
    protected const OPCODE = "0A";
    protected Hex $exponent;

    public function execute(): void
    {
        $num = $this->context->stack->pop();
        $this->exponent = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::exp($num, $this->exponent));
    }

    protected function getGasCalculators(): array
    {
        return [
            new StaticGasCalculator(10),
            new ExpGasCalculator($this->exponent)
        ];
    }
}