<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Mulmod;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class MulmodTest extends TestCase
{
    public function testMulMod(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $context->stack->push("12");

        $opcode = new Mulmod($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("9")], $context->stack->all());

        $this->assertEquals("09", Mulmod::getOpcode());
        $this->assertEquals(8, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
