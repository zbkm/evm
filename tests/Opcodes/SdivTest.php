<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Sdiv;
use Zbkm\Evm\Utils\Hex;

class SdivTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Sdiv::class;
    protected string $opcode = "05";
    protected int $staticGas = 5;

    public static function dataProvider(): array
    {
        return [
            [["0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"], Hex::from("2")->get()],
        ];
    }

}
