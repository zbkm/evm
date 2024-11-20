<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Div;

class DivTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Div::class;
    protected string $opcode = "04";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [["10", "10"], "1"],
            [["1", "2"], "0"]
        ];
    }
}
