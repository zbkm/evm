<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

class Push1 extends BaseOpcode
{
    protected const STATIC_GAS = 3;
    protected const OPCODE = "60";

    public function execute(): void
    {
        $this->context->stack->push($this->element);
    }

    public function getBytesSkip(): int
    {
        return 1;
    }
}