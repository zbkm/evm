<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Sub;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class SubTest extends TestCase
{
    public function testSub(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("10");

        $opcode = new Sub($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("0")], $context->stack->all());

        $this->assertEquals("03", Sub::getOpcode());
        $this->assertEquals(3, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
