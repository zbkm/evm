<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\AccessList;
use Zbkm\Evm\Interfaces\IStorage;
use Zbkm\Evm\Opcodes\SStore;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * Gas Calculator for SStore opcode
 *
 * @see SStore
 */
class SStoreGasCalculator extends BaseGasCalculator
{
    /**
     * @param IStorage   $storage      storage
     * @param Hex        $key          key
     * @param Hex        $value        value
     * @param Hex        $currentValue current value of the storage slot
     */
    public function __construct(
        protected IStorage   &$storage,
        protected Hex        $key,
        protected Hex        $value,
        protected Hex        $currentValue
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        // Definitions:
        // value: value from the stack input.
        // current_value: current value of the storage slot.
        // original_value: value of the storage slot before the current transaction.
        //
        // if value == current_value
        //     base_dynamic_gas = 100
        // else if current_value == original_value
        //     if original_value == 0
        //         base_dynamic_gas = 20000
        //     else
        //         base_dynamic_gas = 2900
        // else
        //     base_dynamic_gas = 100

        $originalValue = $this->storage->getOriginalValue($this->key);
        $baseDynamicGas = 100;

        if (
            HexMath::eq($this->currentValue, $originalValue) and
            !HexMath::eq($this->value, $this->currentValue)
        ) {
            if (HexMath::eq($originalValue, Hex::from(0))) {
                $baseDynamicGas = 20000;
            } else {
                $baseDynamicGas = 2900;
            }
        }

        return $baseDynamicGas;
    }

    /**
     * @inheritDoc
     */
    public function calculateRefundGas(): int
    {
        // Gas refunds
        // if value != current_value
        //     if current_value == original_value
        //         if original_value != 0 and value == 0
        //             gas_refunds += 4800
        //     else
        //         if original_value != 0
        //             if current_value == 0
        //                 gas_refunds -= 4800
        //             else if value == 0
        //                 gas_refunds += 4800
        //         if value == original_value
        //             if original_value == 0
        //                 gas_refunds += 20000 - 100
        //             else
        //                 gas_refunds += 5000 - 2100 - 100

        $originalValue = $this->storage->getOriginalValue($this->key);

        $gasRefund = 0;

        if (!HexMath::eq($this->value, $this->currentValue)) {
            if (HexMath::eq($this->currentValue, $originalValue)) {
                if (!HexMath::eq($originalValue, Hex::from(0)) and HexMath::eq($this->value, Hex::from(0))) {
                    $gasRefund += 4800;
                }
            } else {
                if (!HexMath::eq($originalValue, Hex::from(0))) {
                    if (HexMath::eq($this->currentValue, Hex::from(0))) {
                        $gasRefund -= 4800;
                    } elseif (HexMath::eq($this->value, Hex::from(0))) {
                        $gasRefund += 4800;
                    }
                }
                if (HexMath::eq($this->value, $originalValue)) {
                    if (HexMath::eq($originalValue, Hex::from(0))) {
                        $gasRefund += 20000 - 100;
                    } else {
                        $gasRefund += 5000 - 2100 - 100;
                    }
                }
            }
        }
        return 0 > $gasRefund ? -$gasRefund : $gasRefund;
    }
}