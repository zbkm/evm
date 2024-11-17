<?php
declare(strict_types=1);

namespace Utils;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;
use PHPUnit\Framework\TestCase;

class HexMathTest extends TestCase
{
    public function testExp(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("2");
        $result = HexMath::exp($a, $b);
        $this->assertEquals(Hex::from("100")->get(), $result->get());

        $a = Hex::from("2");
        $b = Hex::from("2");
        $result = HexMath::exp($a, $b);
        $this->assertEquals(Hex::from("4")->get(), $result->get());
    }

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

    public function testMul(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("10");
        $result = HexMath::mul($a, $b);
        $this->assertEquals(Hex::from("100")->get(), $result->get());

        $a = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $b = Hex::from("2");
        $result = HexMath::mul($a, $b);
        $this->assertEquals(gmp_strval("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE",16), $result->get());
    }

    public function testSub(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("10");
        $result = HexMath::sub($a, $b);
        $this->assertEquals(Hex::from("0")->get(), $result->get());

        $a = Hex::from("0");
        $b = Hex::from("1");
        $result = HexMath::sub($a, $b);
        $this->assertEquals(gmp_strval("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF", 16), $result->get());
    }

    public function testDiv(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("10");
        $result = HexMath::div($a, $b);
        $this->assertEquals(Hex::from("1")->get(), $result->get());

        $a = Hex::from("1");
        $b = Hex::from("2");
        $result = HexMath::div($a, $b);
        $this->assertEquals(gmp_strval("0"), $result->get());
    }

    public function testSdiv(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("10");
        $result = HexMath::sdiv($a, $b);
        $this->assertEquals(Hex::from("1")->get(), $result->get());

        $a = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE");
        $b = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF");
        $result = HexMath::sdiv($a, $b);
        $this->assertEquals(gmp_strval("2"), $result->get());

        $a = Hex::from("1");
        $b = Hex::from("0");
        $result = HexMath::sdiv($a, $b);
        $this->assertEquals(Hex::from("0")->get(), $result->get());
    }

    public function testMod(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("3");
        $result = HexMath::mod($a, $b);
        $this->assertEquals(Hex::from("1")->get(), $result->get());

        $a = Hex::from("17");
        $b = Hex::from("5");
        $result = HexMath::mod($a, $b);
        $this->assertEquals(gmp_strval("3", 16), $result->get());
    }

    public function testSmod(): void
    {
        $a = Hex::from("10");
        $b = Hex::from("3");
        $result = HexMath::smod($a, $b);
        $this->assertEquals(Hex::from("1")->get(), $result->get());

        $a = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF8");
        $b = Hex::from("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFD");
        $result = HexMath::smod($a, $b);
        $this->assertEquals(gmp_strval("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE", 16), $result->get());
    }
}
