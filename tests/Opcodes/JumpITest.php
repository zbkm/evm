<?php
declare(strict_types=1);

namespace Opcodes;

use Helpers\ContextGenerator;
use Zbkm\Evm\Opcodes\JumpI;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class JumpITest extends TestCase
{
    public function testJumpI()
    {
        $context = ContextGenerator::get();
        $context->stack->push("1");
        $context->stack->push("55");
        $jump = new JumpI($context);

        $jump->execute();

        $this->assertEquals(Hex::from("55")->getInt(), $jump->jumpTo());
        $this->assertEmpty($context->stack->all());
        $this->assertTrue($jump->isJump());
    }

    public function testNoJumpI()
    {
        $context = ContextGenerator::get();
        $context->stack->push("0");
        $context->stack->push("55");
        $jump = new JumpI($context);

        $jump->execute();
        $this->assertFalse($jump->isJump());
    }

    public function testMetadata(): void
    {
        $context = ContextGenerator::get();
        $jump = new JumpI($context);

        $this->assertEquals("57", JumpI::getOpcode());
        $this->assertEquals(10, $jump->getSpentGas());
        $this->assertEquals(0, $jump->getRefundGas());
        $this->assertEquals(0, $jump->getBytesSkip());
        $this->assertFalse($jump->isRevert());
        $this->assertFalse($jump->isStop());
    }
}
