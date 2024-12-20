<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

/**
 * Halts execution
 */
class Stop extends BaseOpcode
{
    protected const OPCODE = "00";

    public function execute(): void
    {
    }

    public function isStop(): bool
    {
        return true;
    }

    protected function getGasCalculators(): array
    {
        return [];
    }
}