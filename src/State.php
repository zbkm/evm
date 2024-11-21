<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class State
{
    public function __construct(
        public string $from,
        public string $to,
        public string $origin,
        public string $caller,
        public string $value,
        public string $gasPrice,
        public string $calldata,
    )
    {
    }
}