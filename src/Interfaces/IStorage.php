<?php
declare(strict_types=1);

namespace Zbkm\Evm\Interfaces;

use Zbkm\Evm\Utils\Hex;

/**
 * Storage
 */
interface IStorage
{
    /**
     * Return storage value for slot. Return 0 if slot not given
     *
     * @param Hex $slot slot
     * @return Hex value
     */
    public function get(Hex $slot): Hex;

    /**
     * Get the current value from the commited state
     *
     * @param Hex $slot
     * @return Hex
     */
    public function getOriginalValue(Hex $slot): Hex;

    /**
     * Set value for slot. Adds to the save queue.
     *
     * @param Hex $slot  slot
     * @param Hex $value value
     * @return void
     */
    public function set(Hex $slot, Hex $value): void;

    /**
     * Save changes to the database.
     *
     * @return void
     */
    public function commit(): void;

    /**
     * Roll back all specified changes that were not commit.
     *
     * @return void
     */
    public function flushTemp(): void;
}