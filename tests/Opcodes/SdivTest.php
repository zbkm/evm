<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Sdiv;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class SdivTest extends TestCase
{
    public function testAdd(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE");
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");

        $opcode = new Sdiv($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("2")], $context->stack->all());

        $this->assertEquals("05", Sdiv::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
