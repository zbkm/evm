<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Add;
use Zbkm\Evm\Opcodes\Addmod;
use Zbkm\Evm\Opcodes\Div;
use Zbkm\Evm\Opcodes\Exp;
use Zbkm\Evm\Opcodes\Mapping;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Opcodes\Mod;
use Zbkm\Evm\Opcodes\Mul;
use Zbkm\Evm\Opcodes\Mulmod;
use Zbkm\Evm\Opcodes\Push1;
use Zbkm\Evm\Opcodes\Sdiv;
use Zbkm\Evm\Opcodes\Smod;
use Zbkm\Evm\Opcodes\Stop;
use Zbkm\Evm\Opcodes\Sub;

class MappingTest extends TestCase
{
    public function testOpcodeMapper()
    {
        $this->assertEquals([
            "00" => Stop::class,
            "01" => Add::class,
            "60" => Push1::class,
            "08" => Addmod::class,
            "04" => Div::class,
            "0A" => Exp::class,
            "06" => Mod::class,
            "02" => Mul::class,
            "09" => Mulmod::class,
            "05" => Sdiv::class,
            "07" => Smod::class,
            "03" => Sub::class
        ], Mapping::getOpcodeMapping());
    }
}
