<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use kornrunner\Keccak;
use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;

/**
 * Get hash of an account’s code
 */
class ExtCodeHash extends BaseOpcode
{
    protected const OPCODE = "3F";
    protected int $size;
    protected string $address;

    public function execute(): void
    {
        $this->address = "0x{$this->context->stack->pop()->get()}";
        $code = $this->context->ethereum->getCode($this->address);

        $hash = $code !== null ? Keccak::hash(hex2bin($code), 256) : "0";
        $this->context->stack->push($hash);
    }

    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator($this->context->accessList, AccessListType::Address, $this->address, 2600, 100),
        ];
    }
}