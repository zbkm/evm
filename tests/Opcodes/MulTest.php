<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Mul;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class MulTest extends TestCase
{
    public function testMul(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("10");

        $opcode = new Mul($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("100")], $context->stack->all());

        $this->assertEquals("02", Mul::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
