<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CallValue;
use Zbkm\Evm\Utils\Hex;

class CallValueTest extends BaseOpcodeTestCase
{
    protected string $testedClass = CallValue::class;
    protected string $opcode = "34";
    protected int $staticGas = 2;

    protected const VALUE = "123456789";

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::VALUE)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->value = self::VALUE;
        return $context;
    }
}