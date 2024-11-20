<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Mul;
use Zbkm\Evm\Utils\Hex;

class MulTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Mul::class;
    protected string $opcode = "02";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [["10", "10"], Hex::from("100")->get()]
        ];
    }
}
