<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\BlockHash;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\MockEthereum;

class BlockHashTest extends BaseOpcodeTestCase
{
    protected string $testedClass = BlockHash::class;
    protected string $opcode = "40";
    protected int $staticGas = 20;

    public static function dataProvider(): array
    {
        return [
            [["1"], Hex::from(MockEthereum::DEFAULT_BLOCK_HASH)->get()],
            [["2"], Hex::from("0")->get()],
        ];
    }
}
