<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Add;

class AddTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Add::class;
    protected string $opcode = "01";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["10", "10"], "20"],
            [["1", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"], "0"]
        ];
    }
}
