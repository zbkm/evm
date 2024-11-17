<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use SeekableIterator;
use Zbkm\Evm\Exceptions\CodePositionOutOfBounds;

/**
 * Class for read code
 */
class CodeReader implements SeekableIterator
{
    protected string $data;

    protected int $position = 0;

    /**
     * @param string $data code
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * Set position to 0
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Get current byte
     *
     * @return string
     */
    public function current(): string
    {
        return substr($this->data, $this->position, 2);
    }

    /**
     * Get current position
     *
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * Go to next instruction
     *
     * @return void
     */
    public function next(): void
    {
        $this->position += 2;
    }

    /**
     * Checking if there are more bytes in the code
     *
     * @return bool
     */
    public function valid(): bool
    {
        return strlen($this->data) > $this->position;
    }

    /**
     * Change position to any value
     *
     * @param int $offset new position
     * @return void
     */
    public function seek(int $offset): void
    {
        if (strlen($this->data) >= $offset) {
            throw new CodePositionOutOfBounds();
        }

        $this->position = $offset;
    }

    /**
     * Read and skip a certain amount bytes
     *
     * @param int $length bytes count
     * @return string readed value
     */
    public function readAndSkip(int $length): string
    {
        $data = substr($this->data, $this->position + 2, $length * 2);
        $this->skip($length);
        return $data;
    }

    /**
     * Skip certain amount bytes
     *
     * @param int $offset offset
     * @return void
     */
    public function skip(int $offset): void
    {
        $this->position += $offset * 2 + 2;
    }
}