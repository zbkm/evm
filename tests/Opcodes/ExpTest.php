<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Exp;

class ExpTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Exp::class;
    protected string $opcode = "0A";
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["10", "2"], "100", 60],
            [["2", "1a"], "4000000", 60],
            [["2", "F4238455"], "0", 210]
        ];
    }
}