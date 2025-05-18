<?php
declare(strict_types=1);

namespace Opcodes;

use Helpers\ContextGenerator;
use Zbkm\Evm\Opcodes\JumpDest;
use PHPUnit\Framework\TestCase;

class JumpDestTest extends TestCase
{
    // opcode no any actions
    public function testMetadata(): void
    {
        $context = ContextGenerator::get();
        $jump = new JumpDest($context);

        $this->assertEquals("5B", JumpDest::getOpcode());
        $this->assertEquals(1, $jump->getSpentGas());
        $this->assertEquals(0, $jump->getRefundGas());
        $this->assertEquals(0, $jump->getBytesSkip());
        $this->assertFalse($jump->isRevert());
        $this->assertFalse($jump->isStop());
    }
}
