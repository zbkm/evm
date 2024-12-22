<?php
declare(strict_types=1);

namespace Zbkm\Evm\Storages;

use Zbkm\Evm\Interfaces\IStorage;
use Zbkm\Evm\Utils\Hex;

/**
 * Keeps all storage in memory
 */
class MemoryStorage implements IStorage
{
    /**
     * @var array<string, Hex>
     */
    protected array $data = [];

    /**
     * Array with not-commited slots changes
     *
     * @var array<string, Hex>
     */
    protected array $temp = [];

    /**
     * @inheritDoc
     */
    public function get(Hex $slot): Hex
    {
        if (!isset($this->temp[$slot->get()]) && !isset($this->data[$slot->get()])) {
            return Hex::from(0);
        }

        return $this->temp[$slot->get()] ?? $this->data[$slot->get()];
    }

    /**
     * @inheritDoc
     */
    public function getOriginalValue(Hex $slot): Hex
    {
        if (!isset($this->data[$slot->get()])) {
            return Hex::from(0);
        }

        return $this->data[$slot->get()];
    }

    /**
     * @inheritDoc
     */
    public function set(Hex $slot, Hex $value): void
    {
        $this->temp[$slot->get()] = $value;
    }

    /**
     * @inheritDoc
     */
    public function commit(): void
    {
        $this->data = array_merge($this->data, $this->temp);
    }

    /**
     * @inheritDoc
     */
    public function flushTemp(): void
    {
        $this->temp = [];
    }


    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return array_merge($this->data, $this->temp);
    }
}