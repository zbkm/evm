<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

/**
 * Helper for working with byte strings
 */
class CodeStringHelper
{
    /**
     * Get slice for bytes string
     *
     * @param string $data bytes string
     * @param int    $offset offset
     * @param int    $size bytes size
     * @return string string slice
     */
    public static function getPart(string $data, int $offset, int $size): string
    {
        $data = self::remove0x($data);
        $start = $offset * 2;
        $length = $size * 2;
        $part = substr($data, $start, $length);
        return str_pad($part, $length, "0");
    }

    /**
     * Count size for bytes string
     *
     * @param string $data bytes string
     * @return int data size
     */
    public static function getSize(string $data): int
    {
        $data = self::remove0x($data);
        return intdiv(strlen($data), 2);
    }

    /**
     * Remove 0x start from string
     *
     * @param string $data bytes string
     * @return string bytes string
     */
    protected static function remove0x(string $data): string
    {
        return str_starts_with($data, "0x") ? substr($data, 2) : $data;
    }
}