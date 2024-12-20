<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;


use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;

/**
 * Get balance of the given account
 */
class Balance extends BaseOpcode
{
    protected const OPCODE = "31";
    protected string $value;

    public function execute(): void
    {
        $this->value = "0x{$this->context->stack->pop()}";
        $this->context->stack->pushHex(
            $this->context->ethereum->getBalance($this->value)
        );
    }

    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator($this->context->accessList, AccessListType::Address, $this->value, 2600, 100)
        ];
    }
}