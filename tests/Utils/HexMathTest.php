<?php
declare(strict_types=1);

namespace Utils;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;
use PHPUnit\Framework\TestCase;

class HexMathTest extends TestCase
{
    public function testSum(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("10");
        $result = HexMath::sum($a, $b);
        $this->assertEquals(Hex::from("20")->get(), $result->get());

        $a = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $b = Hex::from("1");
        $result = HexMath::sum($a, $b);
        $this->assertEquals("0", $result->get());
    }
}
