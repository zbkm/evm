<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Coinbase;
use Zbkm\Evm\Utils\Hex;

class CoinbaseTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Coinbase::class;
    protected string $opcode = "41";
    protected int $staticGas = 2;

    protected const ADDRESS = "0x5B38Da6a701c568545dCfcB03FcB875f56beddC4";

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::ADDRESS)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->coinbase = self::ADDRESS;
        return $context;
    }
}
