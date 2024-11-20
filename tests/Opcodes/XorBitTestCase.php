<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\XorBit;

class XorBitTestCase extends BaseOpcodeTestCase
{
    protected string $testedClass = XorBit::class;
    protected string $opcode = "18";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0xF0", "0xF"], "ff"],
            [["0xFF", "0xFF"], "0"]
        ];
    }
}
