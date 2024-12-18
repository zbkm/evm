<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\BaseFee;
use Zbkm\Evm\Utils\Hex;

class BaseFeeTest extends BaseOpcodeTestCase
{
    protected string $testedClass = BaseFee::class;
    protected string $opcode = "48";
    protected int $staticGas = 2;

    protected const BASE_FEE = 10;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::BASE_FEE)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->baseFee = self::BASE_FEE;
        return $context;
    }
}
