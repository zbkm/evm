<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;

/**
 * Alter the program counter
 *
 * @note
 */
class Jump extends BaseOpcode
{
    protected const OPCODE = "56";
    protected int $dest;

    /**
     * @inheritDoc
     */
    public function isJump(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function jumpTo(): int
    {
        return $this->dest;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->dest = $this->context->stack->pop()->getInt();
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(8)];
    }
}