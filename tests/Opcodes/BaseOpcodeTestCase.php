<?php
declare(strict_types=1);

namespace Opcodes;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Context;
use Zbkm\Evm\Interfaces\IOpcode;
use Zbkm\Evm\State;
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

    protected Context $context;

    /**
     * @return array [string[] <- stack,  string <- result, int <- gas (for dynamic)]
     */
    abstract public static function dataProvider(): array;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->context = static::getContext();
    }

    public function getContext(): Context
    {
        return new Context(new State(
            from: "0xbe862ad9abfe6f22bcb087716c7d89a26051f74c",
            to: "0x9bbfed6889322e016e0a02ee459d306fc19545d8",
            value: "0",
            gasPrice: "10",
            gasLimit: 345,
            calldata: "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
            block: 1,
            timestamp: 1,
            coinbase: "0x5B38Da6a701c568545dCfcB03FcB875f56beddC4",
            prevRandao: "0xce124dee50136f3f93f19667fb4198c6b94eecbacfa300469e5280012757be94",
            chainId: 1,
            baseFee: 10
        ), new Storage());
    }

    #[DataProvider("dataProvider")]
    public function test(array $values, string $expected, int $dynamicGas = null): void
    {
        foreach (array_reverse($values) as $value) {
            $this->context->stack->push($value);
        }

        $opcode = new $this->testedClass($this->context);
        $opcode->execute();
        $this->assertEquals($expected, $this->context->stack->pop()->get());

        if ($this->isDynamicGas) {
            $this->assertEquals($dynamicGas, $opcode->getSpentGas());
        }
    }

    public function testMetadata(): void
    {
        $opcode = new $this->testedClass($this->context);

        $this->assertEquals($this->opcode, $this->testedClass::getOpcode());
        if (!$this->isDynamicGas) {
            $this->assertEquals($this->staticGas, $opcode->getSpentGas());
        }
        $this->assertEquals(0, $opcode->getBytesSkip());
        $this->assertEquals($this->isStop, $opcode->isStop());
    }
}