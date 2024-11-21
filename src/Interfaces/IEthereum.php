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
     * @return string bytes string
     */
    public function getCode(string $address): string;
}