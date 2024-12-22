<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\MStore;

class MStoreTest extends BaseMemoryBasedOpcodeTestCase
{
    protected string $testedClass = MStore::class;
    protected string $opcode = "52";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0", "0xFF"], "00000000000000000000000000000000000000000000000000000000000000FF", 9],
            [["1", "0xFF"], "0000000000000000000000000000000000000000000000000000000000000000ff00000000000000000000000000000000000000000000000000000000000000", 12]
        ];
    }
}