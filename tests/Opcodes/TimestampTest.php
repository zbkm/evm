<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Coinbase;
use Zbkm\Evm\Opcodes\Timestamp;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class TimestampTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Timestamp::class;
    protected string $opcode = "42";
    protected int $staticGas = 2;

    protected const TIMESTAMP = 1636704767;

    public static function dataProvider(): array
    {
        return [
            [[], Hex::from(self::TIMESTAMP)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->timestamp = self::TIMESTAMP;
        return $context;
    }
}
