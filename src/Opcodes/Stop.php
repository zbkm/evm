<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Stop extends BaseOpcode
{
    public function execute(): void
    {
    }

    public function isStop(): bool
    {
        return true;
    }

    public function getSpentGas(): int
    {
        return 0;
    }

    static public function getOpcode(): string
    {
        return "00";
    }
}