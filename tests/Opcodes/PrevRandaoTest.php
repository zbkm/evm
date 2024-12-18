<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\PrevRandao;
use Zbkm\Evm\Utils\Hex;

class PrevRandaoTest extends BaseOpcodeTestCase
{
    protected string $testedClass = PrevRandao::class;
    protected string $opcode = "44";
    protected int $staticGas = 2;

    protected const PREV_RANDAO = "0xce124dee50136f3f93f19667fb4198c6b94eecbacfa300469e5280012757be94";

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::PREV_RANDAO)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->prevRandao = self::PREV_RANDAO;
        return $context;
    }
}
