<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class State
{
    /**
     * @param string $from
     * @param string $to
     * @param string $value
     * @param string $gasPrice
     * @param int    $gasLimit
     * @param string $calldata
     * @param int    $block       current block number
     * @param int    $timestamp   unix timestamp of the current block
     * @param string $coinbase    miner's 20-byte address
     * @param string $prevRandao  previous block's RANDAO mix https://eips.ethereum.org/EIPS/eip-4399
     * @param int    $chainId     chain id of the network
     * @param int    $baseFee     base fee in wei
     * @param int    $blobBaseFee blob base fee in wei
     * @param string $origin
     * @param string $caller
     */
    public function __construct(
        public string $from,
        public string $to,
        public string $value,
        public string $gasPrice,
        public int    $gasLimit,
        public string $calldata,
        public int    $block,
        public int    $timestamp,
        public string $coinbase,
        public string $prevRandao,
        public int    $chainId,
        public int    $baseFee,
        public int    $blobBaseFee,
        public string $origin = "",
        public string $caller = "",
        public int    $gasLeft = 0
    )
    {
        if ($this->origin === "") {
            $this->origin = $this->from;
        }

        if ($this->caller === "") {
            $this->caller = $this->from;
        }
    }
}