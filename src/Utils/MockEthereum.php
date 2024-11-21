<?php
declare(strict_types=1);

namespace Zbkm\Evm\Utils;

use Zbkm\Evm\Interfaces\IEthereum;

class MockEthereum implements IEthereum
{
    public function getBalance(string $address): Hex
    {
        return Hex::from(0);
    }

    public function getCode(string $address): string
    {
        return "";
    }
}