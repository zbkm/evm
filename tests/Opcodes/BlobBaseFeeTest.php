<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\BlobBaseFee;
use Zbkm\Evm\Utils\Hex;

class BlobBaseFeeTest extends BaseOpcodeTestCase
{
    protected string $testedClass = BlobBaseFee::class;
    protected string $opcode = "4A";
    protected int $staticGas = 3;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(10)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->blobBaseFee = 10;
        return $context;
    }
}
