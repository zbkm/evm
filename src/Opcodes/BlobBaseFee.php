<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Returns the value of the blob base-fee of the current block
 */
class BlobBaseFee extends BaseOpcode
{
    protected const OPCODE = "4A";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->blobBaseFee));
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(3)];
    }

}