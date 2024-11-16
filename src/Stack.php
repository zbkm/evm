<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Exceptions\StackOverflowException;

class Stack
{
    const MAX_SIZE = 1024;

    protected array $data = [];

    public function push(string $value): void
    {
        if (count($this->data) == self::MAX_SIZE) {
            throw new StackOverflowException();
        }

        $this->data[] = $value;
    }

    public function pop(int $index): void
    {
        $this->checkIndexAvailability($index);

        array_splice($this->data, $index - 1, 1);
    }

    public function get(int $index): string
    {
        $this->checkIndexAvailability($index);

        return $this->data[$index];
    }

    /**
     * Return all stack
     *
     * @return string[]
     */
    public function all(): array
    {
        return $this->data;
    }

    public function swap(int $first, int $second): void
    {
        $this->checkIndexAvailability($first);
        $this->checkIndexAvailability($second);

        $temp = $this->data[$first - 1];
        $this->data[$first - 1] = $this->data[$second - 1];
        $this->data[$second - 1] = $temp;
    }

    protected function checkIndexAvailability(int $index): void
    {
        if (0 >= $index || $index > count($this->data)) {
            throw new StackOverflowException();
        }
    }
}