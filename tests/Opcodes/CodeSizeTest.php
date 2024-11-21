<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CodeSize;

class CodeSizeTest extends BaseOpcodeTestCase
{
    protected string $testedClass = CodeSize::class;
    protected string $opcode = "38";
    protected int $staticGas = 2;

    public static function dataProvider(): array
    {
        return [
            [["0"], "20"],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->code = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
        return $context;
    }
}
