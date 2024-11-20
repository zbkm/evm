<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Gt;

class GtTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Gt::class;
    protected string $opcode = "11";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["10", "9"], "1"],
            [["10", "10"], "0"]
        ];
    }
}
