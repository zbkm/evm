<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Exp;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class ExpTest extends TestCase
{
    public function testExp(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("2");

        $opcode = new Exp($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("100")], $context->stack->all());

        $this->assertEquals("0A", Exp::getOpcode());
        $this->assertEquals(60, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());

        // dynamic gas count
        $context = new Context(new Storage());
        $context->stack->push("2A00F2");
        $context->stack->push("2");

        $opcode = new Exp($context);
        $opcode->execute();
        $this->assertEquals(160, $opcode->getSpentGas());

    }
}