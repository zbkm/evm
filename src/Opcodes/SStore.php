<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Exceptions\InsufficientlyGasException;
use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;
use Zbkm\Evm\Gas\SStoreGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Save word to storage
 */
class SStore extends BaseOpcode
{
    protected const OPCODE = "55";
    protected Hex $slot;
    protected Hex $value;
    protected Hex $currentValue;

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->slot = $this->context->stack->pop();
        $this->value = $this->context->stack->pop();
        $this->currentValue = $this->context->storage->get($this->slot);
        $this->context->storage->set($this->slot, $this->value);
    }

    /**
     * @inheritDoc
     *
     * @todo add: The current execution context is from a STATICCALL (since Byzantium fork).
     */
    public function isRevert(): bool
    {
        if (parent::isRevert()) {
            return true;
        }

        if (2300 >= $this->context->state->gasLeft) {
            $this->revertException = new InsufficientlyGasException("When the amount of gas left to the transaction is less than or equal 2300");
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator(
                $this->context->accessList, AccessListType::Slot,
                $this->slot->get(), 2100, 0
            ),
            new SStoreGasCalculator(
                $this->context->storage,
                $this->slot,
                $this->value,
                $this->currentValue
            ),
        ];
    }
}