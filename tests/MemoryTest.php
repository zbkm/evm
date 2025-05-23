<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Memory;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class MemoryTest extends TestCase
{
    public function testSet32(): void
    {
        $memory = new Memory();
        $memory->set32(Hex::from("0x20"), Hex::from("1488"));
        $this->assertEquals("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001488", $memory->data());
        $memory->set32(Hex::from("0x00"), Hex::from("1488"));
        $this->assertEquals("00000000000000000000000000000000000000000000000000000000000014880000000000000000000000000000000000000000000000000000000000001488", $memory->data());
        $memory->set32(Hex::from("0x10"), Hex::from("1488"));
        $this->assertEquals("00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000148800000000000000000000000000001488", $memory->data());
    }

    public function testGet(): void
    {
        $memory = new Memory();
        $memory->set32(Hex::from("0x20"), Hex::from("1488"));
        $this->assertEquals("0000000000000000000000000000000000000000000000000000000000001488", $memory->get(Hex::from("0x20"), 32));
        $this->assertEquals("1488", $memory->get(Hex::from("0x3E"), 2));
    }

    public function testSet(): void
    {
        $memory = new Memory();
        $memory->set(Hex::from("0x00"), 1, Hex::from("a1"));
        $this->assertEquals("a100000000000000000000000000000000000000000000000000000000000000", $memory->data());

        $memory->set(Hex::from("0x05"), 2, Hex::from("1488"));
        $this->assertEquals("a100000000148800000000000000000000000000000000000000000000000000", $memory->data());

        $memory->set(Hex::from("0x20"), 2, Hex::from("1488"));
        $this->assertEquals("a1000000001488000000000000000000000000000000000000000000000000001488000000000000000000000000000000000000000000000000000000000000", $memory->data());
    }

    public function testSetMultiple(): void
    {
        $memory = new Memory();
        $memory->setMultiple(Hex::from("0x20"), 32, [
            Hex::from("ffb7897c50432c5582277e659253e5645e9575594a15fa5d9ea3a7b41cd7f2a9"),
            Hex::from("672cb24657b0bf1b2a275b6c82ee8de1176299824f92274ce0877a4dec360169"),
        ]);
        $this->assertEquals("0000000000000000000000000000000000000000000000000000000000000000ffb7897c50432c5582277e659253e5645e9575594a15fa5d9ea3a7b41cd7f2a9672cb24657b0bf1b2a275b6c82ee8de1176299824f92274ce0877a4dec3601690000000000000000000000000000000000000000000000000000000000000000", $memory->data());
    }

    public static function extendProvider(): array
    {
        return [
            ["0x20", "0000000000000000000000000000000000000000000000000000000000000000"],
            ["0x60", "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"],
            ["0x02", "0000000000000000000000000000000000000000000000000000000000000000"],
            ["0x27", "00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000"],
        ];
    }

    #[DataProvider("extendProvider")]
    public function testExtend(string $offset, string $expect)
    {
        $memory = new Memory();
        $memory->extend(Hex::from($offset));
        $this->assertEquals($expect, $memory->data());
    }
}
