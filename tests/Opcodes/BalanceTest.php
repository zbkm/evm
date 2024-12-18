<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Balance;

class BalanceTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Balance::class;
    protected string $opcode = "31";
    protected int $staticGas = 0;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0x9bbfed6889322e016e0a02ee459d306fc19545d8"], "0", 100],
        ];
    }
}
