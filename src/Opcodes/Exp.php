<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class Exp extends BaseOpcode
{
    protected const STATIC_GAS = 10;
    protected const OPCODE = "0A";
    protected Hex $exponent;

    public function execute(): void
    {
        $num = $this->context->stack->pop();
        $this->exponent = $this->context->stack->pop();
        $this->context->stack->pushHex(HexMath::exp($num, $this->exponent));
    }

    public function getSpentGas(): int
    {
        // dynamic_gas = 50 * exponent_byte_size
        $dynamicGas = 50 * count(str_split($this->exponent->get(), 2));
        return self::STATIC_GAS + $dynamicGas;
    }
}