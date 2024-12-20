<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\ExtCodeCopy;

class ExtCodeCopyTest extends BaseOpcodeTestCase
{
    protected string $testedClass = ExtCodeCopy::class;
    protected string $opcode = "3C";
    protected int $staticGas = 0;
    protected bool $isDynamicGas = true;

    protected const CODE = "0x7DFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF7F";

    public static function dataProvider(): array
    {
        return [
            [
                ["0x43a61f3f4c73ea0d444c5c1c1a8544067a86219b", "0", "0", "20"],
                "0000000000000000000000000000000000000000000000000000000000000000", 2609],
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
        $context->code = self::CODE;
        return $context;
    }
}
