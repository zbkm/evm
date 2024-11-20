<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Shr;

class ShrTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Shr::class;
    protected string $opcode = "1C";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["1", "2"], "1"],
            [["4", "0xFF"], "f"]
        ];
    }
}
