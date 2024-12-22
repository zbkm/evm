<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use kornrunner\Keccak;
use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Gas\MemoryWordGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Compute Keccak-256 hash
 */
class Keccak256 extends BaseOpcode
{
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

    protected function getGasCalculators(): array
    {
        return [
            new StaticGasCalculator(30),
            new MemoryWordGasCalculator($this->size),
            new MemoryExtendGasCalculator($this->initialMemorySize, $this->context->memory->size())
        ];
    }
}