<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Div;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class DivTest extends TestCase
{
    public function testDiv(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("10");

        $opcode = new Div($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("1")], $context->stack->all());

        $this->assertEquals("04", Div::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
