<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\SignExtend;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class SignExtendTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [["0", "0xFF"], [Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")]],
            [["0", "0x7F"], [Hex::from("0x7F")]]
        ];
    }

    #[DataProvider("dataProvider")]
    public function test(array $values, array $expected): void
    {
        $context = new Context(new Storage());

        foreach ($values as $value) {
            $context->stack->push($value);
        }

        $opcode = new SignExtend($context);
        $opcode->execute();
        $this->assertEquals($expected, $context->stack->all());
    }

    public function testMetadata(): void
    {
        $context = new Context(new Storage());
        $opcode = new SignExtend($context);

        $this->assertEquals("0B", SignExtend::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
