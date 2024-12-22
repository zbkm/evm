<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;
use Zbkm\Evm\Utils\Hex;

/**
 * Load word from storage
 */
class SLoad extends BaseOpcode
{
    protected const OPCODE = "54";
    protected Hex $slot;

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->slot = $this->context->stack->pop();
        $value = $this->context->storage->get($this->slot);
        $this->context->stack->push($value->get());
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator(
                $this->context->accessList, AccessListType::Slot,
                $this->slot->get(), 2100, 100
            )
        ];
    }
}