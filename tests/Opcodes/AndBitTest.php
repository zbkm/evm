<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\AndBit;
use Zbkm\Evm\Utils\Hex;

class AndBitTest extends BaseOpcodeTestCase
{
    protected string $testedClass = AndBit::class;
    protected string $opcode = "16";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0xF", "0xF"], Hex::from("0xF")->get()],
            [["0xFF", "0"], Hex::from("0")->get()]
        ];
    }
}
