<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Addmod;

class AddmodTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Addmod::class;
    protected string $opcode = "08";
    protected int $staticGas = 8;

    public static function dataProvider(): array
    {
        return [
            [["A", "A", "8"], "4"],
            [["0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", "2", "2"], "1"]
        ];
    }
}
