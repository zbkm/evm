<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use kornrunner\Keccak;

/**
 * Get hash of an account’s code
 */
class ExtCodeHash extends BaseOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "3F";
    protected int $size;

    public function execute(): void
    {
        $address = $this->context->stack->pop();
        $code = $this->context->ethereum->getCode($address->getHex());

        $hash = $code !== null ? Keccak::hash(hex2bin($code), 256) : "0";
        $this->context->stack->push($hash);
    }

    public function getSpentGas(): int
    {
        $dynamicGas = 100;
        return self::STATIC_GAS + $dynamicGas;
    }
}