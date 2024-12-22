<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

class MStore8 extends BaseOpcode
{
    protected const OPCODE = "53";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $offset = $this->context->stack->pop();
        $value = $this->context->stack->pop();
        if (strlen($value->get()) > 2) {
            $value = Hex::from(substr($value->get(), 0, 2));
        }

        $this->context->memory->set($offset, 1, $value);
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