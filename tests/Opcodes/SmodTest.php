<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Smod;
use Zbkm\Evm\Utils\Hex;

class SmodTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Smod::class;
    protected string $opcode = "07";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [[
                "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF8",
                "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD"],
                Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE")->get()
            ],
            [["10", "3"], "1"]
        ];
    }
}
