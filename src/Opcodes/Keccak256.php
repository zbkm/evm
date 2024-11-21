<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use kornrunner\Keccak;
use Zbkm\Evm\Gas\MemoryGasHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Compute Keccak-256 hash
 */
class Keccak256 extends BaseOpcode
{
    protected const STATIC_GAS = 30;
    protected const OPCODE = "20";
    protected int $size;

    public function execute(): void
    {
        $offset = $this->context->stack->pop();
        $this->size = $this->context->stack->pop()->getInt();
        $data = $this->context->memory->get($offset, $this->size);
        $hash = Keccak::hash(hex2bin($data), 256);
        $this->context->stack->pushHex(Hex::from($hash));
    }

    public function getSpentGas(): int
    {
        // minimum_word_size = (size + 31) / 32
        // dynamic_gas = 6 * minimum_word_size + memory_expansion_cost
        $minimumWordSize = ($this->size + 31) / 32;
        $memoryExpansionCost = MemoryGasHelper::getExpansionPrice($this->context->memory->size(), $this->initialMemorySize);
        $dynamicGas = 6 * ~~$minimumWordSize + $memoryExpansionCost;
        return self::STATIC_GAS + $dynamicGas;
    }
}