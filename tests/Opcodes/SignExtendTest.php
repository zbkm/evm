<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\SignExtend;
use Zbkm\Evm\Utils\Hex;

class SignExtendTest extends BaseOpcodeTestCase
{
    protected string $testedClass = SignExtend::class;
    protected string $opcode = "0B";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [["0", "0xFF"], Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")->get()],
            [["0", "0x7F"], Hex::from("0x7F")->get()]
        ];
    }
}
