<?php
declare(strict_types=1);

namespace Gas;

use Helpers\ContextGenerator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Gas\AccessListType;
use Zbkm\Evm\Opcodes\Balance;

class AccessListGasCalculatorTest extends TestCase
{
    public function testAddress(): void
    {
        $address = "0x9bbfed6889322e016e0a02ee459d306fc19545d8";
        $context = ContextGenerator::get();

        $this->assertFalse($context->accessList->inList(AccessListType::Address, $address));
        $context->stack->push($address);
        $opcode = new Balance($context);
        $opcode->execute();
        $this->assertSame(2600, $opcode->getSpentGas());

        $this->assertTrue($context->accessList->inList(AccessListType::Address, $address));
        $context->stack->push($address);
        $opcode = new Balance($context);
        $opcode->execute();
        $this->assertSame(100, $opcode->getSpentGas());
    }
}
