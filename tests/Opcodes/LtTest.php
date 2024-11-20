<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Lt;

class LtTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Lt::class;
    protected string $opcode = "10";
    protected int $staticGas = 3;


    public static function dataProvider(): array
    {
        return [
            [["9", "10"], "1"],
            [["10", "10"], "0"]
        ];
    }
}
