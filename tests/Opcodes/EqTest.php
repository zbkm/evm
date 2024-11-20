<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Eq;

class EqTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Eq::class;
    protected string $opcode = "14";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["10", "10"], "1"],
            [["10", "5"], "0"]
        ];
    }
}
