<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\HexMath;

/**
 * Retrieve single byte from word
 */
class Byte extends BaseOpcode
{
    protected const OPCODE = "1A";

    public function execute(): void
    {
        $i = $this->context->stack->pop();
        $x = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::byte($i, $x));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }
}