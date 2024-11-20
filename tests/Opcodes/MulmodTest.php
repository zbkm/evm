<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Mulmod;

class MulmodTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Mulmod::class;
    protected string $opcode = "09";
    protected int $staticGas = 8;

    public static function dataProvider(): array
    {
        return [
            [["A", "A", "8"], "4"],
            [["0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", "C"], "9"]
        ];
    }
}
