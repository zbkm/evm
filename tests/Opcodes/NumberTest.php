<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Number;
use Zbkm\Evm\Utils\Hex;

class NumberTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Number::class;
    protected string $opcode = "43";
    protected int $staticGas = 2;

    protected const NUMBER = 1636704767;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::NUMBER)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->block = self::NUMBER;
        return $context;
    }
}
