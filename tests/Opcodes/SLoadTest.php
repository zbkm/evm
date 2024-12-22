<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\SLoad;
use Zbkm\Evm\Utils\Hex;

class SLoadTest extends BaseOpcodeTestCase
{
    protected string $testedClass = SLoad::class;
    protected string $opcode = "54";
    protected int $staticGas = 2100;

    public static function dataProvider(): array
    {
        return [
            [["0"], Hex::from(46)->get()],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->storage->set(Hex::from(0), Hex::from(46));
        return $context;
    }

    public function testMetadata(): void
    {
        $this->assertEquals($this->opcode, $this->testedClass::getOpcode());

        $this->context->stack->push("0");
        $opcode = new SLoad($this->context);
        $opcode->execute();
        $this->assertEquals(2100, $opcode->getSpentGas());

        $this->context->stack->push("0");
        $opcode = new SLoad($this->context);
        $opcode->execute();
        $this->assertEquals(100, $opcode->getSpentGas());
    }
}
