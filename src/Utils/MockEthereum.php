<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use Zbkm\Evm\Interfaces\IEthereum;

class MockEthereum implements IEthereum
{
    /**
     * @var array<string, string|null>
     */
    protected array $codes;

    /**
     * @var array<int, string>
     */
    protected array $blockHashes;

    /**
     * @var array<string, Hex>
     */
    protected array $balances;

    public const DEFAULT_BLOCK_HASH = "0x29045A592007D0C246EF02C2223570DA9522D0CF0F73282C79A1BC8F0BB2C238";

    public function getBalance(string $address): Hex
    {
        if (!isset($this->balances[$address])) {
            return Hex::from(0);
        } else {
            return $this->balances[$address];
        }
    }

    public function setBalance(string $address, Hex $wei): void
    {
        $this->balances[$address] = $wei;
    }

    public function getCode(string $address): string|null
    {
        if (!isset($this->codes[$address])) {
            return "";
        } else {
            return $this->codes[$address];
        }
    }

    public function setCode(string $address, string|null $code): void
    {
        $this->codes[$address] = $code;
    }

    public function getBlockHash(int $blockNumber): string
    {
        if (!isset($this->blockHashes[$blockNumber])) {
            return self::DEFAULT_BLOCK_HASH; // default value
        } else {
            return $this->blockHashes[$blockNumber];
        }
    }

    public function setBlockHash(int $blockNumber, string $hash): void
    {
        $this->blockHashes[$blockNumber] = $hash;
    }
}