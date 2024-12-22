<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CodeCopy;

class CodeCopyTest extends BaseMemoryBasedOpcodeTestCase
{
    protected string $testedClass = CodeCopy::class;
    protected string $opcode = "39";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    protected const CODE = "0x7DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF7F";

    public static function dataProvider(): array
    {
        return [
            [["0", "0", "0x20"], "7DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF7F", 12],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->code = self::CODE;
        return $context;
    }
}
