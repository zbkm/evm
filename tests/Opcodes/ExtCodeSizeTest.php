<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\ExtCodeSize;

class ExtCodeSizeTest extends BaseOpcodeTestCase
{
    protected string $testedClass = ExtCodeSize::class;
    protected string $opcode = "3B";
    protected int $staticGas = 0;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0x43a61f3f4c73ea0d444c5c1c1a8544067a86219b"], "0", 2600],
        ];
    }
}
