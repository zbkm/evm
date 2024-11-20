<?php
declare(strict_types=1);

namespace Opcodes;
use Zbkm\Evm\Opcodes\Sar;
use Zbkm\Evm\Utils\Hex;

class SarTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Sar::class;
    protected string $opcode = "1D";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["1", "2"], "1"],
            [["4", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF0"], Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")->get()]
        ];
    }
}
