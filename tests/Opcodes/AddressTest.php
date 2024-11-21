<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Address;
use Zbkm\Evm\Utils\Hex;

class AddressTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Address::class;
    protected string $opcode = "30";
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
        $context->state->address = self::ADDRESS;
        return $context;
    }
}
