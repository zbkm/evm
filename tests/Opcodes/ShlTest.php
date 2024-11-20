<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Shl;

class ShlTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Shl::class;
    protected string $opcode = "1B";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["1", "1"], "2"],
            [["4", "0xFF00000000000000000000000000000000000000000000000000000000000000"], "f000000000000000000000000000000000000000000000000000000000000000"]
        ];
    }
}
