<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\SelfBalance;
use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Context;

class SelfBalanceTest extends BaseOpcodeTestCase
{
    protected string $testedClass = SelfBalance::class;
    protected string $opcode = "47";
    protected int $staticGas = 5;

    protected const BALANCE = 50000;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::BALANCE)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->ethereum->setBalance($context->state->to, Hex::from(self::BALANCE));
        return $context;
    }
}
