<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Copy input data in current environment to memory
 *
 * @note For out of bound bytes, 0s will be copied.
 */
class CallDataCopy extends BaseOpcode
{
    protected const OPCODE = "37";
    protected int $size;

    public function execute(): void
    {
        $destOffset = $this->context->stack->pop();
        $offset = $this->context->stack->pop();
        $this->size = $this->context->stack->pop()->getInt();

        $callDataPart = CodeStringHelper::getPart($this->context->state->calldata, $offset->getInt(), $this->size);
        // todo test on size > 32 byte
        $this->context->memory->set($destOffset, $this->size, Hex::from($callDataPart));
    }

    protected function getGasCalculators(): array
    {
        return [
            new StaticGasCalculator(3),
            new MemoryExtendGasCalculator($this->initialMemorySize, $this->size, $this->context->memory->size())
        ];
    }
}