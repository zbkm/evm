<?php
declare(strict_types=1);

namespace Opcodes;

use Zbkm\Evm\Context;
use Zbkm\Evm\Opcodes\ExtCodeHash;
use Zbkm\Evm\Utils\Hex;

class ExtCodeHashTest extends BaseOpcodeTestCase
{
    protected string $testedClass = ExtCodeHash::class;
    protected string $opcode = "3F";
    protected int $staticGas = 0;
    protected bool $isDynamicGas = true;

    public static function dataProvider(): array
    {
        return [
            [["0x43a61f3f4c73ea0d444c5c1c1a8544067a86219b"], Hex::from("0xc5d2460186f7233c927e7db2dcc703c0e500b653ca82273b7bfad8045d85a470")->get(), 100],
            [["0xf8e81D47203A594245E36C48e151709F0C19fBe8"], Hex::from("93985dd99c235cea0f45ba23e77bcc15527d62edcf722bb7d1205b68fc12d106")->get(), 100],
        ];
    }

    public function getContext(): Context
    {
        $context = parent::getContext();
        $context->ethereum->setCode(strtolower("0xf8e81D47203A594245E36C48e151709F0C19fBe8"), "6080604052348015600e575f80fd5b50603e80601a5f395ff3fe60806040525f80fdfea2646970667358221220488ae5dd890127d1e955d744d5c0fe68cb2cea1a1ef4d00e4fe731fc1cba64c864736f6c634300081a0033");
        return $context;
    }
}
