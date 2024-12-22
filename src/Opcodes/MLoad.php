<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;

class MLoad extends BaseOpcode
{
    protected const OPCODE = "51";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $offset = $this->context->stack->pop();
        $value = $this->context->memory->get($offset, 32);

        $this->context->stack->push($value);
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