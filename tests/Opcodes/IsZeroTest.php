<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\IsZero;

class IsZeroTest extends BaseOpcodeTestCase
{
    protected string $testedClass = IsZero::class;
    protected string $opcode = "15";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["10"], "0"],
            [["0"], "1"]
        ];
    }
}
