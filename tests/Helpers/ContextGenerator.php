<?php
declare(strict_types=1);

namespace Helpers;

use Zbkm\Evm\Context;
use Zbkm\Evm\State;
use Zbkm\Evm\Storages\MemoryStorage;

class ContextGenerator
{
    static public function get(): Context
    {
        return new Context(new State(
            from: "0xbe862ad9abfe6f22bcb087716c7d89a26051f74c",
            to: "0x9bbfed6889322e016e0a02ee459d306fc19545d8",
            value: "0",
            gasPrice: "10",
            gasLimit: 345,
            calldata: "0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
            block: 1,
            timestamp: 1,
            coinbase: "0x5B38Da6a701c568545dCfcB03FcB875f56beddC4",
            prevRandao: "0xce124dee50136f3f93f19667fb4198c6b94eecbacfa300469e5280012757be94",
            chainId: 1,
            baseFee: 10,
            blobBaseFee: 10
        ), new MemoryStorage());
    }
}