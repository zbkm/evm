<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\AccessList;

/**
 * Gas calculation according to the presence of the value in the AccessList
 */
class AccessListGasCalculator extends BaseGasCalculator
{
    /**
     * @param AccessList     $al AccessList Instance
     * @param AccessListType $type Type of access list
     * @param string         $value key
     * @param int            $coldPrice price on cold state
     * @param int            $warmPrice price on warm state
     */
    public function __construct(
        public AccessList $al,
        public AccessListType $type,
        public string $value,
        public int $coldPrice,
        public int $warmPrice
    )
    {
        $this->value = strtoupper($this->value);
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        if (!$this->al->inList($this->type, $this->value)) {
            $this->al->add($this->type, $this->value);
            return $this->coldPrice;
        }

        return $this->warmPrice;
    }
}