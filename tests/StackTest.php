<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Exceptions\StackOverflowException;
use Zbkm\Evm\Stack;
use PHPUnit\Framework\TestCase;
use Zbkm\Evm\Utils\Hex;

class StackTest extends TestCase
{
    public function testPush()
    {
        $stack = new Stack();
        $stack->push("FF");
        $stack->push("00");

        $this->assertEquals([Hex::from("FF"), Hex::from("00")], $stack->all());

        for ($i = 0; 1024 - 2 > $i; $i++) {
            $stack->push("AA");
        }

        $this->expectException(StackOverflowException::class);
        $stack->push("AA");
    }

    public function testPop()
    {
        $stack = new Stack();
        $stack->push("12356");
        $stack->pop(1);

        $this->assertEquals([], $stack->all());

        $this->expectException(StackOverflowException::class);
        $stack->pop(1);
    }


    public static function swapProvider(): array
    {
        return [
            [
                ["1", "2"],
                ["2", "1"],
                1
            ],
            [
                ["1", "0", "2"],
                ["2", "0", "1"],
                2
            ],
            [
                ["1", "0", "0", "2"],
                ["2", "0", "0", "1"],
                3
            ],
            [
                ["1", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "1"],
                4
            ],
            [
                ["1", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "1"],
                5
            ],
            [
                ["1", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "1"],
                6
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "1"],
                7
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "1"], 8],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                9
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                10]
            ,
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                11
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                12
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                13
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                14
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                15
            ],
            [
                ["1", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "2"],
                ["2", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "1"],
                16
            ]
        ];
    }

    #[DataProvider("swapProvider")]
    public function testSwap(array $values, array $expected, int $element): void
    {
        $stack = new Stack();

        foreach ($values as $value) {
            $stack->push($value);
        }

        $stack->swap(1, $element + 1);
        $actual = array_map(function (Hex $element) { return $element->get(); }, $stack->all());
        $this->assertSame($expected, $actual);
    }
}
