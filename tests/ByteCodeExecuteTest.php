<?php
declare(strict_types=1);

use Helpers\ContextGenerator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\CodeExecutor;
use Zbkm\Evm\Utils\Hex;

class ByteCodeExecuteTest extends TestCase
{
    public function testPush()
    {
        $context = ContextGenerator::get();
        CodeExecutor::execute($context, "604260006001");

        $actual = array_map(function (Hex $element) { return $element->get(); }, $context->stack->all());
        $this->assertSame(["42", "0", "1"], $actual);

    }
}