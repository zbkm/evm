<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\OrBit;
use Zbkm\Evm\Utils\Hex;

class OrBitTest extends BaseOpcodeTestCase
{
    protected string $testedClass = OrBit::class;
    protected string $opcode = "17";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0xF0", "0xF"], Hex::from("0xFF")->get()],
            [["0xFF", "0xFF"], Hex::from("0xFF")->get()]
        ];
    }
}
