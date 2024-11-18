<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\IsZero;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class IsZeroTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            ["10", Hex::from("0")],
            ["0", Hex::from("1")]
        ];
    }

    #[DataProvider("dataProvider")]
    public function test(string $value, Hex $expected): void
    {
        $context = new Context(new Storage());
        $context->stack->push($value);

        $opcode = new IsZero($context);
        $opcode->execute();
        $this->assertEquals($expected, $context->stack->pop());
    }

    public function testMetadata(): void
    {
        $context = new Context(new Storage());
        $opcode = new IsZero($context);

        $this->assertEquals("15", IsZero::getOpcode());
        $this->assertEquals(3, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
