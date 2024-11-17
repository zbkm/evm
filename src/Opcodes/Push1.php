<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Push1 extends BaseOpcode
{
    protected const STATIC_GAS = 3;

    public function execute(): void
    {
        $this->context->stack->push($this->element);
    }

    public function getBytesSkip(): int
    {
        return 1;
    }

    static public function getOpcode(): string
    {
        return "60";
    }
}