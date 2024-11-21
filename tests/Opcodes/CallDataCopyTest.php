<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\CallDataCopy;

class CallDataCopyTest extends BaseOpcodeTestCase
{
    protected string $testedClass = CallDataCopy::class;
    protected string $opcode = "37";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    protected const CALLDATA = "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

    public static function dataProvider(): array
    {
        return [
            [["0", "0", "0x20"], "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", 12],
        ];
    }

    #[DataProvider("dataProvider")]
    public function test(array $values, string $expected, int $dynamicGas = null): void
    {
        foreach (array_reverse($values) as $value) {
            $this->context->stack->push($value);
        }

        $opcode = new $this->testedClass($this->context);
        $opcode->execute();
        $this->assertEquals(strtolower($expected), $this->context->memory->data());

        if ($this->isDynamicGas) {
            $this->assertEquals($dynamicGas, $opcode->getSpentGas());
        }
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->state->calldata = self::CALLDATA;
        return $context;
    }
}
