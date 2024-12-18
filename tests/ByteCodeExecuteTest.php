<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Zbkm\Evm\CodeExecutor;
use Zbkm\Evm\Context;
use Zbkm\Evm\State;
use Zbkm\Evm\Storage;
use Zbkm\Evm\Utils\Hex;

class ByteCodeExecuteTest extends TestCase
{
    public function testPush()
    {
        $context = new Context(new State(
            from: "0xbe862ad9abfe6f22bcb087716c7d89a26051f74c",
            to: "0x9bbfed6889322e016e0a02ee459d306fc19545d8",
            value: "0",
            gasPrice: "0",
            gasLimit: 500_000,
            calldata: "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
            block: 1,
            timestamp: 1,
            coinbase: "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
            prevRandao: "0x0",
            chainId: 1,
            baseFee: 10,
            origin: "0xbe862ad9abfe6f22bcb087716c7d89a26051f74c",
            caller: "0xbe862ad9abfe6f22bcb087716c7d89a26051f74c"
        ), new Storage());
        CodeExecutor::execute($context, "604260006001");

        $actual = array_map(function (Hex $element) { return $element->get(); }, $context->stack->all());
        $this->assertSame(["42", "0", "1"], $actual);

    }
}