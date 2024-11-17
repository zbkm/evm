<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Mod;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class ModTest extends TestCase
{
    public function testMod(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("17");
        $context->stack->push("5");

        $opcode = new Mod($context);
        $opcode->execute();
        $this->assertEquals([Hex::from("2")], $context->stack->all());

        $this->assertEquals("06", Mod::getOpcode());
        $this->assertEquals(5, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
    }
}
