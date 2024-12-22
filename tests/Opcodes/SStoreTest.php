<?php
declare(strict_types=1);

namespace Opcodes;

use Helpers\ContextGenerator;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Opcodes\SStore;
use Zbkm\Evm\Utils\Hex;

class SStoreTest extends TestCase
{
    public function test(): void
    {
        $context = ContextGenerator::get();

        // empty storage, input new value
        $context->stack->push("ffff");
        $context->stack->push("0");
        $opcode = new SStore($context);
        $opcode->execute();
        $this->assertEquals(["0" => Hex::from("ffff")], $context->storage->all());
        $this->assertEquals(22100, $opcode->getSpentGas());

        // change storage value, when already stored
        $context->stack->push("ffff");
        $context->stack->push("0");
        $opcode = new SStore($context);
        $opcode->execute();
        $this->assertEquals(["0" => Hex::from("ffff")], $context->storage->all());
        $this->assertEquals(100, $opcode->getSpentGas());
        $context->storage->commit();

        // access list warm, input unique, current and original same
        $context->stack->push("fffd");
        $context->stack->push("0");
        $opcode = new SStore($context);
        $opcode->execute();
        $this->assertEquals(2900, $opcode->getSpentGas());


        // metadata
        $this->assertEquals("55", SStore::getOpcode());
    }

}