<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\MStore8;

class MStore8Test extends BaseMemoryBasedOpcodeTestCase
{
    protected string $testedClass = MStore8::class;
    protected string $opcode = "53";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0", "0xFFFF"], "ff00000000000000000000000000000000000000000000000000000000000000", 9],
            [["1", "0xFF"], "00ff000000000000000000000000000000000000000000000000000000000000", 9]
        ];
    }
}