<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Get versioned hashes
 */
class BlobHash extends BaseOpcode
{
    protected const OPCODE = "49";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $index = $this->context->stack->pop()->getInt();
        $blobHash = $this->context->ethereum->getBlobHash($index);

        if ($blobHash === null) {
            // blob hash index > blob hashes length.
            $this->context->stack->push("0");
        } else {
            $this->context->stack->push($blobHash);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}