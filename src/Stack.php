<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Exceptions\StackOverflowException;
use Zbkm\Evm\Utils\Hex;

class Stack
{
    const MAX_SIZE = 1024;

    /**
     * @var Hex[]
     */
    protected array $data = [];

    public function push(string $value): void
    {
        $this->pushHex(Hex::from($value));
    }

    public function pushHex(Hex $value): void
    {
        if (count($this->data) == self::MAX_SIZE) {
            throw new StackOverflowException();
        }

        $this->data = [$value, ...$this->data];
    }

    public function pop(int $index = 1): Hex
    {
        $this->checkIndexAvailability($index);

        return array_splice($this->data, $index - 1, 1)[0];
    }

    public function get(int $index): Hex
    {
        $this->checkIndexAvailability($index);

        return $this->data[$index];
    }

    /**
     * Return all stack
     *
     * @return Hex[]
     */
    public function all(): array
    {
        return array_reverse($this->data);
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