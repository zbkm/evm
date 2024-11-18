<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Sgt;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class SgtTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [["0", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"], [Hex::from("1")]],
            [["10", "10"], [Hex::from("0")]]
        ];
    }

    #[DataProvider("dataProvider")]
    public function test(array $values, array $expected): void
    {
        $context = new Context(new Storage());

        foreach ($values as $value) {
            $context->stack->push($value);
        }

        $opcode = new Sgt($context);
        $opcode->execute();
        $this->assertEquals($expected, $context->stack->all());
    }

    public function testMetadata(): void
    {
        $context = new Context(new Storage());
        $opcode = new Sgt($context);

        $this->assertEquals("13", Sgt::getOpcode());
        $this->assertEquals(3, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
