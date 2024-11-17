<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Add;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class AddTest extends TestCase
{
    public function testAdd(): void
    {
        $context = new Context(new Storage());
        $context->stack->push("10");
        $context->stack->push("10");

        $opcode = new Add($context);
        $opcode->execute();

        $this->assertEquals(3, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertFalse($opcode->isStop());
        $this->assertEquals([Hex::from("20")->get()], $context->stack->all());
    }
}
