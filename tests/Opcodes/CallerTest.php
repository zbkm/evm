<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Caller;
use Zbkm\Evm\Utils\Hex;

class CallerTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Caller::class;
    protected string $opcode = "33";
    protected int $staticGas = 2;

    protected const ADDRESS = "0x9bbfed6889322e016e0a02ee459d306fc19545d8";

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::ADDRESS)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->caller = self::ADDRESS;
        return $context;
    }
}