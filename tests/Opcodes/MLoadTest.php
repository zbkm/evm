<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\MLoad;
use Zbkm\Evm\Utils\Hex;

class MLoadTest extends BaseOpcodeTestCase
{
    protected string $testedClass = MLoad::class;
    protected string $opcode = "51";
    protected int $staticGas = 3;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0"], "ff", 3],
            [["1"], "ff00", 6]
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->memory->set(Hex::from(0), 32, Hex::from("0x00000000000000000000000000000000000000000000000000000000000000FF"));
        return $context;
    }
}
