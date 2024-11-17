<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use InvalidArgumentException;
use Zbkm\Evm\Context;
use Zbkm\Evm\Interfaces\IOpcode;

abstract class BaseOpcode implements IOpcode
{
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

    public function isStop(): bool
    {
        return false;
    }

    public function getBytesSkip(): int
    {
        return 0;
    }
}