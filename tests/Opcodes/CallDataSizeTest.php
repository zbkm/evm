<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CallDataSize;
use Zbkm\Evm\Utils\Hex;

class CallDataSizeTest extends BaseOpcodeTestCase
{
    protected string $testedClass = CallDataSize::class;
    protected string $opcode = "36";
    protected int $staticGas = 2;

    protected const CALLDATA = "0xFF";

    public static function dataProvider(): array
    {
        return [
            [["0"], Hex::from("1")->get()]
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->calldata = self::CALLDATA;
        return $context;
    }
}
