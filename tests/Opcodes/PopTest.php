<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Opcodes\Pop;

class PopTest extends BaseOpcodeTestCase
{
    protected string $testedClass = Pop::class;
    protected string $opcode = "50";
    protected int $staticGas = 2;

    public static function dataProvider(): array
    {
        return [
            [["1", "1"], "1"]
        ];
    }

    public function testLastElementInStack(): void
    {
        $this->context->stack->push("325");
        $opcode = new $this->testedClass($this->context);
        $opcode->execute();

        $this->assertEmpty($this->context->stack->all());
    }
}
