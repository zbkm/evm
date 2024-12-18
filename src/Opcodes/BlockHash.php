<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

/**
 * Get the hash of one of the 256 most recent complete blocks
 */
class BlockHash extends BaseOpcode
{
    protected const STATIC_GAS = 20;
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
}