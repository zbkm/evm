<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Mod;

class ModTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Mod::class;
    protected string $opcode = "06";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [["A", "3"], "1"],
            [["11", "5"], "2"]
        ];
    }
}
