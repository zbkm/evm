<?php
declare(strict_types=1);

namespace Zbkm\Evm\Interfaces;

use Zbkm\Evm\Utils\Hex;

/**
 * Interaction with the ethereum network
 */
interface IEthereum
{
    /**
     * Get ethereum balance for wallet
     *
     * @param string $address address
     * @return Hex balance in wei
     */
    public function getBalance(string $address): Hex;

    /**
     * Get code for wallet
     *
     * @param string $address address
     * @return string|null bytes string (empty string for no code) or null if contract destroyed
     */
    public function getCode(string $address): string|null;

    /**
     * Get block hash for block
     *
     * @param int $blockNumber block number
     * @return string block hash
     */
    public function getBlockHash(int $blockNumber): string;
}