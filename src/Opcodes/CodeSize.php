<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get size of code running in current environment
 */
class CodeSize extends BaseOpcode
{
    protected const OPCODE = "38";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            Hex::from(count(str_split($this->context->code, 2)))
        );
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}