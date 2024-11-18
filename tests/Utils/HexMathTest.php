<?php
declare(strict_types=1);

namespace Utils;

use PHPUnit\Framework\Attributes\DataProvider;
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
        $this->assertEquals(gmp_strval("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFE", 16), $result->get());
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


    public static function signExtendProvider(): array
    {
        return [
            ["80", "0x126af4", "0x126af4"], // Invalid Byte Number
            ["0", "0", "0"], // 0 0
            ["0", "0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff", "0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff"], // 0 -1
            ["0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe", "0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe", "0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe"], // -2 -2
            ["0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff", "0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff", "0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff"], // -1 -1
            ["0xf00000000000000001", "0xff", "0xff"], // <lagre number> 255
            ["0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff", "0x00", "0x00"], // -1 0
            ["0", "0x122f6a", "0x6a"], // bit is not set
            ["1", "0x126af4", "0x6af4"], // bit is not set in higher byte
            ["1", "0x12faf4", "0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffaf4"], // bit is set in higher byte
            ["0x010000000000000001", "0x8000", "0x8000"], // overflow the byte number value
            ["0xf0000000000001", "0xFFFF", "0xFFFF"], // try to overflow the byte number value
            ["0", "0x122ff4", "0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff4"], // set bit (0, 0x<whatever>ff)
            ["31", "1", "0x01"], // 31, positive value
            ["31", HexMath::sub(Hex::from(0), Hex::from(1))->get(), "0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff"], // 31, negative value
        ];
    }

    #[DataProvider("signExtendProvider")]
    public function testSignExtend(string $aValue, string $bValue, string $expected): void
    {
        $a = Hex::from($aValue);
        $b = Hex::from($bValue);
        $result = HexMath::signExtend($a, $b);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }

    public static function byteProvider(): array
    {
        return [
            ["1F", "0xFF", "0xFF"],
            ["1E", "0xFF00", "0xFF"],
        ];
    }

    #[DataProvider("byteProvider")]
    public function testByte(string $iValue, string $xValue, string $expected): void
    {
        $i = Hex::from($iValue);
        $x = Hex::from($xValue);
        $result = HexMath::byte($i, $x);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }

    public static function shlProvider(): array
    {
        return [
            ["1", "1", "2"],
            ["4", "0xFF00000000000000000000000000000000000000000000000000000000000000", "0xF000000000000000000000000000000000000000000000000000000000000000"],
        ];
    }

    #[DataProvider("shlProvider")]
    public function testShl(string $nValue, string $xValue, string $expected): void
    {
        $n = Hex::from($nValue);
        $x = Hex::from($xValue);
        $result = HexMath::shl($n, $x);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }

    public static function shrProvider(): array
    {
        return [
            ["1", "2", "1"],
            ["4", "0xFF", "0xF"],
        ];
    }

    #[DataProvider("shrProvider")]
    public function testShr(string $nValue, string $xValue, string $expected): void
    {
        $n = Hex::from($nValue);
        $x = Hex::from($xValue);
        $result = HexMath::shr($n, $x);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }

    public static function notProvider(): array
    {
        return [
            ["0", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"]
        ];
    }

    #[DataProvider("notProvider")]
    public function testNot(string $value, string $expected): void
    {
        $n = Hex::from($value);
        $result = HexMath::not($n);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }

    public static function sarProvider(): array
    {
        return [
            ["1", "2", "1"],
            ["4", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF0", "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF"],
        ];
    }

    #[DataProvider("sarProvider")]
    public function testSar(string $nValue, string $xValue, string $expected): void
    {
        $n = Hex::from($nValue);
        $x = Hex::from($xValue);
        $result = HexMath::sar($n, $x);
        $this->assertEquals(Hex::from($expected)->get(), $result->get());
    }
}
