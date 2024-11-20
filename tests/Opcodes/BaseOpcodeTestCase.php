<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Context;
use Zbkm\Evm\Interfaces\IOpcode;
use Zbkm\Evm\Storage;

abstract class BaseOpcodeTestCase extends TestCase
{
    /**
     * @var class-string<IOpcode>
     */
    protected string $testedClass;
    protected string $opcode;
    protected int $staticGas;
    protected bool $isStop = false;
    protected bool $isDynamicGas = false;

    /**
     * @return array [string[] <- stack,  string <- result, int <- gas (for dynamic)]
     */
    abstract public static function dataProvider(): array;

    #[DataProvider("dataProvider")]
    public function test(array $values, string $expected, int $dynamicGas = null): void
    {
        $context = new Context(new Storage());

        foreach (array_reverse($values) as $value) {
            $context->stack->push($value);
        }

        $opcode = new $this->testedClass($context);
        $opcode->execute();
        $this->assertEquals($expected, $context->stack->pop()->get());

        if ($this->isDynamicGas) {
            $this->assertEquals($dynamicGas, $opcode->getSpentGas());
        }
    }

    public function testMetadata(): void
    {
        $context = new Context(new Storage());
        $opcode = new $this->testedClass($context);

        $this->assertEquals($this->opcode, $this->testedClass::getOpcode());
        if (!$this->isDynamicGas) {
            $this->assertEquals($this->staticGas, $opcode->getSpentGas());
        }
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertEquals($this->isStop, $opcode->isStop());
    }
}