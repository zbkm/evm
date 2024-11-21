<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryGasHelper;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Copy code running in current environment to memory
 */
class CodeCopy extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "39";
    protected Hex $size;

    public function execute(): void
    {
        $destOffset = $this->context->stack->pop();
        $offset = $this->context->stack->pop();
        $this->size = $this->context->stack->pop();

        $callDataPart = CodeStringHelper::getPart($this->context->code, $offset->getInt(), $this->size->getInt());

        // todo test on size > 32 byte
        $this->context->memory->set($destOffset, $this->size->getInt(), Hex::from($callDataPart));

    }

    public function getSpentGas(): int
    {
        // minimum_word_size = (size + 31) / 32
        // dynamic_gas = 3 * minimum_word_size + memory_expansion_cost
        $minimumWordSize = ($this->size->getInt() + 31) / 32;
        $memoryExpansionCost = MemoryGasHelper::getExpansionPrice($this->context->memory->size(), $this->initialMemorySize);
        $dynamicGas = 3 * ~~$minimumWordSize + $memoryExpansionCost;
        return self::STATIC_GAS + $dynamicGas;
    }
}