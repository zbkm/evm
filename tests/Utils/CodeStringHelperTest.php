<?php
declare(strict_types=1);

namespace Utils;

use PHPUnit\Framework\Attributes\DataProvider;
use Zbkm\Evm\Utils\CodeStringHelper;
use PHPUnit\Framework\TestCase;

class CodeStringHelperTest extends TestCase
{
    public static function getPartProvider(): array
    {
        return [
            ["0x1234ab", 0, 2, "1234"],
            ["0x1234ab", 2, 2, "ab00"],
            ["0x1234ab", 32, 32, "0000000000000000000000000000000000000000000000000000000000000000"],
            ["0x1234ab", 0, 0, ""],
        ];
    }

    #[DataProvider("getPartProvider")]
    public function testGetPart(string $calldata, int $offset, int $size, string $expect): void
    {
        $this->assertEquals(
            $expect, CodeStringHelper::getPart($calldata, $offset, $size)
        );
    }

    public static function getSizeProvider(): array
    {
        return [
            ["0x0000000000000000000000000000000000000000000000000000000000000000", 32],
            ["0xFF", 1]
        ];
    }

    #[DataProvider("getSizeProvider")]
    public function testGetSize(string $calldata, int $expect): void
    {
        $this->assertEquals(
            $expect, CodeStringHelper::getSize($calldata)
        );
    }
}
