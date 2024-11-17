<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Addmod;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class AddmodTest extends TestCase
{
    public function testAddmod(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("10");
        $context->stack->push("8");

        $opcode = new Addmod($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("4")], $context->stack->all());

        $context = new Context(new Storage());
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $context->stack->push("2");
        $context->stack->push("2");

        $opcode = new Addmod($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("1")], $context->stack->all());

        $this->assertEquals("08", Addmod::getOpcode());
        $this->assertEquals(8, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
