<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryGasHelper;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Copy an account’s code to memory
 */
class ExtCodeCopy extends BaseOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "3C";
    protected int $size;

    public function execute(): void
    {
        $address = $this->context->stack->pop();
        $destOffset = $this->context->stack->pop();
        $offset = $this->context->stack->pop();
        $this->size = $this->context->stack->pop()->getInt();

        $callDataPart = CodeStringHelper::getPart(
            $this->context->ethereum->getCode("0x{$address->get()}"), $offset->getInt(), $this->size
        );

        // todo test on size > 32 byte
        $this->context->memory->set($destOffset, $this->size, Hex::from($callDataPart));
    }

    public function getSpentGas(): int
    {
        // minimum_word_size = (size + 31) / 32
        // dynamic_gas = 3 * minimum_word_size + memory_expansion_cost
        $minimumWordSize = ($this->size + 31) / 32;
        $memoryExpansionCost = MemoryGasHelper::getExpansionPrice($this->context->memory->size(), $this->initialMemorySize);
        $dynamicGas = 3 * ~~$minimumWordSize + $memoryExpansionCost + 100;
        return self::STATIC_GAS + $dynamicGas;
    }
}