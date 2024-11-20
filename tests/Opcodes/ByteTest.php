<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Byte;

class ByteTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Byte::class;
    protected string $opcode = "1A";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["1F", "0xFF"], "ff"],
            [["1E", "0xFF00"], "ff"]
        ];
    }
}
