<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/*
 * 	Mark a valid destination for jumps
 */
class JumpDest extends BaseOpcode
{
    protected const OPCODE = "5B";

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(1)];
    }
}