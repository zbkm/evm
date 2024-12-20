<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Opcodes\Mapping;
use Zbkm\Evm\Utils\CodeReader;

class CodeExecutor
{
    public static function execute(Context $context, string $code): void
    {
        $context->code = $code;
        $reader = new CodeReader($code);

        while ($reader->valid()) {
            $opcode = $reader->current();
            $className = Mapping::getExecutor($opcode);
            $executor = new $className($context);

            if ($executor->getBytesSkip()) {
                $executor->setElement($reader->readAndSkip($executor->getBytesSkip()));
            }

            $executor->execute();

            if ($executor->isStop()) {
                break;
            }

            if (!$executor->getBytesSkip()) {
                $reader->next();
            }
        }
    }
}