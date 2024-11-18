<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Stop extends BaseOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "00";

    public function execute(): void
    {
    }

    public function isStop(): bool
    {
        return true;
    }
}