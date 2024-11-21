<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryGasHelper;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Copy input data in current environment to memory
 */
class CallDataCopy extends BaseOpcode
{
    protected const STATIC_GAS = 3;
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

    public function getSpentGas(): int
    {
        // minimum_word_size = (size + 31) / 32
        // dynamic_gas = 3 * minimum_word_size + memory_expansion_cost
        $minimumWordSize = ($this->size + 31) / 32;
        $memoryExpansionCost = MemoryGasHelper::getExpansionPrice($this->context->memory->size(), $this->initialMemorySize);
        $dynamicGas = 3 * ~~$minimumWordSize + $memoryExpansionCost;
        return self::STATIC_GAS + $dynamicGas;
    }
}