<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Push1 extends BaseOpcode
{
    public function execute(): void
    {
        $this->context->stack->push($this->element);
    }

    public function getBytesSkip(): int
    {
        return 1;
    }

    public function getSpentGas(): int
    {
        return 3;
    }

    static public function getOpcode(): string
    {
        return "60";
    }
}