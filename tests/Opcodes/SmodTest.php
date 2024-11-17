<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Smod;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class SmodTest extends TestCase
{
    public function testSMod(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF8");
        $context->stack->push("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD");

        $opcode = new Smod($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE")], $context->stack->all());

        $this->assertEquals("07", Smod::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
