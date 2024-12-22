<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\Keccak256;
use Zbkm\Evm\Utils\Hex;

class Keccak256Test extends BaseOpcodeTestCase
{
    protected string $testedClass = Keccak256::class;
    protected string $opcode = "20";
    protected int $staticGas = 30;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0", "4"], Hex::from("0x29045A592007D0C246EF02C2223570DA9522D0CF0F73282C79A1BC8F0BB2C238")->get(), 33],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->memory->set(Hex::from(0), 4, Hex::from("FFFFFFFF"));
        return $context;
    }
}
