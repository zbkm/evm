<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Utils\Hex;
use Zbkm\Evm\Utils\HexMath;

class Memory
{
    /**
     * Byte key => byte value mapping
     *
     * @var array<string, string>
     */
    protected array $memory = [];

    /**
     * Last element index (always a multiple of 32 bytes)
     *
     * @var Hex
     */
    protected Hex $lastIndex;

    /**
     * Size slot of 32 bytes
     */
    protected const SLOT_SIZE = "0x20";

    public function __construct()
    {
        $this->lastIndex = Hex::from("0");
    }

    /**
     * Set word (32 byte element) a given position
     *
     * @note If the element is less than 32 bytes, leading zeros will be added.
     * @param Hex $offset element position
     * @param Hex $value  element
     * @return void
     */
    public function set32(Hex $offset, Hex $value): void
    {
        self::setMultiple($offset, 32, [$value]);
    }

    /**
     * Load bytes from memory
     *
     * @param Hex $offset offset in the memory in bytes
     * @param int $size data size
     * @return string byte string
     */
    public function get(Hex $offset, int $size): string
    {
        $result = "";

        for ($i = 0; $i < $size; $i++) {
            $elem = HexMath::sum($offset, Hex::from($i))->get();
            $result .= $this->memory[$elem] ?? "";
        }

        return $result;
    }

    /**
     * Set element a given length in a given position
     *
     * @param Hex $offset element position
     * @param int $size   size in bytes
     * @param Hex $value  element
     * @return void
     */
    public function set(Hex $offset, int $size, Hex $value): void
    {
        self::setMultiple($offset, $size, [$value]);
    }

    /**
     * Set multiple elements
     *
     * @param Hex   $offset element position
     * @param int   $size   element size in bytes
     * @param Hex[] $values elements
     * @return void
     */
    public function setMultiple(Hex $offset, int $size, array $values): void
    {
        $newSize = HexMath::mul(HexMath::sum($offset, Hex::from($size)), Hex::from(count($values)));
        $this->extend($newSize);

        foreach ($values as $value) {
            $strValue = str_pad($value->get(), $size * 2, "0", STR_PAD_LEFT);
            $bytes = str_split($strValue, 2);

            foreach ($bytes as $byte) {
                $this->memory[$offset->get()] = $byte;
                $offset = HexMath::sum($offset, Hex::from("1"));
            }
        }
    }

    /**
     * Extend memory
     *
     * @param Hex $newSize last byte position
     * @return void
     */
    public function extend(Hex $newSize): void
    {
        if (HexMath::cmp($newSize, $this->lastIndex) > 0) {
            $newLastIndex = HexMath::mul(
                HexMath::div(
                    HexMath::sum(
                        $newSize,
                        Hex::from("0x1F")),           // 31
                    Hex::from(self::SLOT_SIZE)),
                Hex::from(self::SLOT_SIZE)
            );
            $elem = clone $newLastIndex;

            while (true) {
                if (HexMath::cmp($elem, $this->lastIndex) == 0) {
                    if ($elem->get() === "0") {
                        $this->memory[$elem->get()] = "00";
                    }
                    break;
                }
                $this->memory[$elem->get()] = "00";
                $elem = HexMath::sub($elem, Hex::from("1"));
            }

            $this->lastIndex = $newLastIndex;
        }
    }

    /**
     * Get all memory in bytes string
     *
     * @return string bytes string
     */
    public function data(): string
    {
        return self::get(Hex::from(0), count($this->memory) - 1);
    }

    /**
     * Get size (last index)
     *
     * @return Hex
     */
    public function size(): Hex
    {
        return $this->lastIndex;
    }
}