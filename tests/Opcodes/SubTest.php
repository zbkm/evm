<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Sub;
use Zbkm\Evm\Utils\Hex;

class SubTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Sub::class;
    protected string $opcode = "03";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["A", "A"], "0"],
            [["0", "1"], Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")->get()]
        ];
    }
}
