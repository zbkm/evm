<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Origin;
use Zbkm\Evm\Utils\Hex;

class OriginTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Origin::class;
    protected string $opcode = "32";
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
        $context->state->origin = self::ADDRESS;
        return $context;
    }
}
