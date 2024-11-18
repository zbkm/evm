<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use InvalidArgumentException;
use Zbkm\Evm\Context;
use Zbkm\Evm\Interfaces\IOpcode;

abstract class BaseOpcode implements IOpcode
{
    protected const STATIC_GAS = 0;
    protected const OPCODE = "00";
    protected string $element = "";

    public function __construct(
        protected Context $context
    )
    {
    }

    public function setElement(string $element): void
    {
        if ($this->getBytesSkip() == 0) {
            throw new InvalidArgumentException("Element installation is not allowed.");
        }

        $this->element = $element;
    }
    static public function getOpcode(): string
    {
        return static::OPCODE;
    }

    public function getSpentGas(): int
    {
        return static::STATIC_GAS;
    }

    public function isStop(): bool
    {
        return false;
    }

    public function getBytesSkip(): int
    {
        return 0;
    }
}