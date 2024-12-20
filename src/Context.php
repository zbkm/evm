<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Utils\MockEthereum;

class Context
{
    public function __construct(
        public State        $state,
        public Storage      $storage,
        public string       $code = "",
        public MockEthereum $ethereum = new MockEthereum(),
        public Memory       $memory = new Memory(),
        public Stack        $stack = new Stack(),
        public AccessList   $accessList = new AccessList(),
    )
    {
    }
}