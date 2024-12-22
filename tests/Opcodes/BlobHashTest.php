<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\BlobHash;
use Zbkm\Evm\Utils\Hex;

class BlobHashTest extends BaseOpcodeTestCase
{
    protected string $testedClass = BlobHash::class;
    protected string $opcode = "49";
    protected int $staticGas = 2;

    public static function dataProvider(): array
    {
        return [
            [["1"], Hex::from("0xFFFFFF")->get()],
            [["2"], Hex::from("0")->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->ethereum->setBlobHash(1, "0xFFFFFF");
        return $context;
    }
}
