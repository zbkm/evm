<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Not;
use Zbkm\Evm\Utils\Hex;

class NotTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Not::class;
    protected string $opcode = "19";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [["0"], Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")->get()],
        ];
    }
}
