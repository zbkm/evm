<?php
declare(strict_types=1);

namespace Opcodes;

use Helpers\ContextGenerator;
use Zbkm\Evm\Opcodes\Jump;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class JumpTest extends TestCase
{
    public function testJumpTo()
    {
        $context = ContextGenerator::get();
        $context->stack->push("55");
        $jump = new Jump($context);

        $jump->execute();

        $this->assertEquals(Hex::from("55")->getInt(), $jump->jumpTo());
        $this->assertEmpty($context->stack->all());
    }

    public function testMetadata(): void
    {
        $context = ContextGenerator::get();
        $jump = new Jump($context);

        $this->assertEquals("56", Jump::getOpcode());
        $this->assertEquals(8, $jump->getSpentGas());
        $this->assertEquals(0, $jump->getRefundGas());
        $this->assertEquals(0, $jump->getBytesSkip());
        $this->assertFalse($jump->isRevert());
        $this->assertFalse($jump->isStop());
        $this->assertTrue($jump->isJump());
    }
}
