<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CallDataLoad;
use Zbkm\Evm\Utils\Hex;

class CallDataLoadTest extends BaseOpcodeTestCase
{
    protected string $testedClass = CallDataLoad::class;
    protected string $opcode = "35";
    protected int $staticGas = 3;
    protected const CALLDATA = "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

    public static function dataProvider(): array
    {
        return [
            [["0"], Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")->get()],
            [["1F"], Hex::from("0xFF00000000000000000000000000000000000000000000000000000000000000")->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->calldata = self::CALLDATA;
        return $context;
    }
}
