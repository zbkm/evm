<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\AccessListGasCalculator;
use Zbkm\Evm\Gas\AccessListType;
use Zbkm\Evm\Gas\MemoryExtendGasCalculator;
use Zbkm\Evm\Utils\CodeStringHelper;
use Zbkm\Evm\Utils\Hex;

/**
 * Copy an account’s code to memory
 */
class ExtCodeCopy extends BaseOpcode
{
    protected const OPCODE = "3C";
    protected int $size;
    protected string $address;

    public function execute(): void
    {
        $this->address = "0x{$this->context->stack->pop()->get()}";
        $destOffset = $this->context->stack->pop();
        $offset = $this->context->stack->pop();
        $this->size = $this->context->stack->pop()->getInt();

        $callDataPart = CodeStringHelper::getPart(
            $this->context->ethereum->getCode($this->address), $offset->getInt(), $this->size
        );

        // todo test on size > 32 byte
        $this->context->memory->set($destOffset, $this->size, Hex::from($callDataPart));
    }

    protected function getGasCalculators(): array
    {
        return [
            new AccessListGasCalculator($this->context->accessList, AccessListType::Address, $this->address, 2600, 100),
            new MemoryExtendGasCalculator($this->initialMemorySize, $this->size, $this->context->memory->size())
        ];
    }
}