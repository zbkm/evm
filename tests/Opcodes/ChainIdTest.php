<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\ChainId;
use Zbkm\Evm\Utils\Hex;

class ChainIdTest extends BaseOpcodeTestCase
{
    protected string $testedClass = ChainId::class;
    protected string $opcode = "46";
    protected int $staticGas = 2;

    protected const CHAIN_ID = 1;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::CHAIN_ID)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->chainId = self::CHAIN_ID;
        return $context;
    }
}
