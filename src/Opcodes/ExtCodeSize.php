<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Get size of an account’s code
 */
class ExtCodeSize extends BaseOpcode
{
    protected const OPCODE = "3B";
    protected string $address;

    public function execute(): void
    {
        $this->address = "0x{$this->context->stack->pop()->get()}";
        $this->context->stack->pushHex(
            Hex::from(
                CodeStringHelper::getSize(
                    $this->context->ethereum->getCode($this->address)
                )
            )
        );
    }

    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator($this->context->accessList, AccessListType::Address, $this->address, 2600, 100),
        ];
    }
}