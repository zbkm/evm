<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

/**
 * Conditionally alter the program counter
 */
class JumpI extends BaseOpcode
{
    protected const OPCODE = "57";
    protected int $dest;
    protected bool $isJump = false;

    /**
     * @inheritDoc
     */
    public function isJump(): bool
    {
        return $this->isJump;
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
        $b = $this->context->stack->pop();

        if (!HexMath::eq(Hex::from(0), $b)) {
            $this->isJump = true;
        }
    }

    /**
     * @inheritDoc
     */
    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(10)];
    }
}