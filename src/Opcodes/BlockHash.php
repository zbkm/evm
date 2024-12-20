<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Get the hash of one of the 256 most recent complete blocks
 */
class BlockHash extends BaseOpcode
{
    protected const OPCODE = "40";

    public function execute(): void
    {
        $blockNumber = $this->context->stack->pop()->getInt();
        if (
            $blockNumber > $this->context->state->block ||
            $this->context->state->block - 256 > $blockNumber
        ) {
            // the block number is not in the valid range.
            $this->context->stack->push("0");
        } else {
            $this->context->stack->push($this->context->ethereum->getBlockHash($blockNumber));
        }
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(20)];
    }
}