<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Exception;
use InvalidArgumentException;
use Zbkm\Evm\Context;
use Zbkm\Evm\Interfaces\IGasCalculator;
use Zbkm\Evm\Interfaces\IOpcode;
use Zbkm\Evm\Utils\Hex;

abstract class BaseOpcode implements IOpcode
{
    /**
     * @const Opcode name
     */
    protected const OPCODE = "00";
    /**
     * @var string
     */
    protected string $element = "";
    /**
     * @var Hex The size of the memory occupied before the execution of the opcode
     */
    protected Hex $initialMemorySize;

    /**
     * @var Exception Exception if opcode revert
     */
    protected Exception $revertException;

    /**
     * @param Context $context
     */
    public function __construct(
        protected Context $context
    )
    {
        $this->initialMemorySize = $this->context->memory->size();
    }

    /**
     * @inheritDoc
     */
    public function setElement(string $element): void
    {
        if ($this->getBytesSkip() == 0) {
            throw new InvalidArgumentException("Element installation is not allowed.");
        }

        $this->element = $element;
    }

    /**
     * @inheritDoc
     */
    static public function getOpcode(): string
    {
        return static::OPCODE;
    }

    /**
     * @inheritDoc
     */
    public function getSpentGas(): int
    {
        return array_reduce($this->getGasCalculators(), function ($carry, $calculator) {
            return $carry + $calculator->calculateGas();
        }, 0);
    }

    public function getRefundGas(): int
    {
        return array_reduce($this->getGasCalculators(), function ($carry, $calculator) {
            return $carry + $calculator->calculateRefundGas();
        }, 0);
    }

    /**
     * @inheritDoc
     */
    public function isStop(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRevert(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isJump(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function jumpTo(): int
    {
        return -1;
    }

    /**
     * @inheritDoc
     */
    public function getBytesSkip(): int
    {
        return 0;
    }

    /**
     * Array with all gas calculators
     *
     * @return IGasCalculator[]
     */
    abstract protected function getGasCalculators(): array;
}