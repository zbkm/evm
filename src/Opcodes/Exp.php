<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class Exp extends BaseOpcode
{
    protected const STATIC_GAS = 10;
    protected Hex $exponent;

    public function execute(): void
    {
        $num = $this->context->stack->pop();
        $this->exponent = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::exp($num, $this->exponent));
    }

    public function getSpentGas(): int
    {
        return self::STATIC_GAS + (count(str_split($this->exponent->get(), 2)) * 50);
    }

    static public function getOpcode(): string
    {
        return "0A";
    }
}