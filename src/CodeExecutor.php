<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Exceptions\InsufficientlyGasException;
use Zbkm\Evm\Exceptions\InvalidJumpException;
use Zbkm\Evm\Opcodes\JumpDest;
use Zbkm\Evm\Opcodes\Mapping;
use Zbkm\Evm\Utils\CodeReader;

class CodeExecutor
{
    public static function execute(Context $context, string $code): void
    {
        $context->code = $code;
        $reader = new CodeReader($code);
        $refundGas = 0;

        while ($reader->valid()) {
            $opcode = $reader->current();
            $className = Mapping::getExecutor($opcode);

            $executor = new $className($context);

            if ($executor->getBytesSkip()) {
                $executor->setElement($reader->readAndSkip($executor->getBytesSkip()));
            }

            $executor->execute();

            // Jump counter offset is not a JUMPDEST. The error is generated even if the JUMP would not have been done
            if ($executor->isJump()) {
                $reader->seek($executor->jumpTo());
                $className = Mapping::getExecutor($reader->current());
                $nextOpcode = $className::getOpcode();
                if ($nextOpcode !== JumpDest::getOpcode()) {
                    throw new InvalidJumpException("New opcode $nextOpcode, not JumpDest");
                }
            }


            if ($executor->isStop()) {
                break;
            }

            $spentGas = $executor->getSpentGas();
            if (0 > $context->state->gasLeft - $spentGas) {
                throw new InsufficientlyGasException();
            }

            $context->state->gasLeft -= $spentGas;
            $refundGas += $executor->getRefundGas();

            $reader->next();
        }
    }
}