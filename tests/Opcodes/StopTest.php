<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Opcodes\Stop;
use Zbkm\Evm\Storage;

class StopTest extends TestCase
{
    public function testStop(): void
    {
        $context = new Context(new Storage());

        $opcode = new Stop($context);
        $opcode->execute();

        $this->assertEquals("00", Stop::getOpcode());
        $this->assertEquals(0, $opcode->getSpentGas());
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertTrue($opcode->isStop());
    }
}
