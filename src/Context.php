<?php
declare(strict_types=1);

namespace Zbkm\Evm;

class Context
{
    public function __construct(
        public Storage     $storage,
        public Memory      $memory = new Memory(),
        public Stack       $stack = new Stack(),
    )
    {
    }
}