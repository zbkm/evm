<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;

class MStore extends BaseOpcode
{
    protected const OPCODE = "52";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $offset = $this->context->stack->pop();
        $value = $this->context->stack->pop();

        $this->context->memory->set($offset, 32, $value);
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [
            new StaticGasCalculator(3),
            new MemoryExtendGasCalculator($this->initialMemorySize, $this->context->memory->size())
        ];
    }
}