<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Sgt;

class SgtTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Sgt::class;
    protected string $opcode = "13";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"], "1"],
            [["10", "10"], "0"]
        ];
    }
}
