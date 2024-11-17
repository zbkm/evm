<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Add;
use Zbkm\Evm\Opcodes\Mapping;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Opcodes\Push1;
use Zbkm\Evm\Opcodes\Stop;

class MappingTest extends TestCase
{
    public function testOpcodeMapper()
    {
        $this->assertEquals([
            "00" => Stop::class,
            "01" => Add::class,
            "60" => Push1::class
        ], Mapping::getOpcodeMapping());
    }
}
