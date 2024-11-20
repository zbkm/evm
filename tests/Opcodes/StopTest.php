<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Stop;

class StopTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Stop::class;
    protected string $opcode = "00";
    protected int $staticGas = 0;
    protected bool $isStop = true;

    public static function dataProvider(): array
    {
        // no crash test, where empty provider
        return [
            [["0"], "0"]
        ];
    }
}
