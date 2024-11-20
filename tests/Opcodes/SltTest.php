<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Slt;

class SltTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Slt::class;
    protected string $opcode = "12";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", "0"], "1"],
            [["10", "10"], "0"]
        ];
    }
}
