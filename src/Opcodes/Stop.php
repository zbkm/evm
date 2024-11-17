<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Stop extends BaseOpcode
{
    protected const STATIC_GAS = 0;

    public function execute(): void
    {
    }

    public function isStop(): bool
    {
        return true;
    }

    static public function getOpcode(): string
    {
        return "00";
    }
}