<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CallDataCopy;

class CallDataCopyTest extends BaseMemoryBasedOpcodeTestCase
{
    protected string $testedClass = CallDataCopy::class;
    protected string $opcode = "37";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    protected const CALLDATA = "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

    public static function dataProvider(): array
    {
        return [
            [["0", "0", "0x20"], "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", 12],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->calldata = self::CALLDATA;
        return $context;
    }
}
