<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;

abstract class BaseMemoryBasedOpcodeTestCase extends BaseOpcodeTestCase
{
    #[DataProvider("dataProvider")]
    public function test(array $values, string $expected, int $dynamicGas = null, int $refundGas = 0): void
    {
        foreach (array_reverse($values) as $value) {
            $this->context->stack->push($value);
        }

        $opcode = new $this->testedClass($this->context);
        $opcode->execute();
        $this->assertEquals(strtolower($expected), $this->context->memory->data());

        if ($this->isDynamicGas) {
            $this->assertEquals($dynamicGas, $opcode->getSpentGas());
            $this->assertEquals($refundGas, $opcode->getRefundGas());
        }
    }
}