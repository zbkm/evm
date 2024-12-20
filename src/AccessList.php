<?php
declare(strict_types=1);

namespace Zbkm\Evm;

use Zbkm\Evm\Gas\AccessListType;


class AccessList
{
    /**
     * @var array<string, string>
     */
    protected array $addresses = [];
    /**
     * @var array<string, string>
     */
    protected array $slots = [];

    /**
     * Add element in list
     *
     * @param AccessListType $type    list type
     * @param string         $element element value
     * @return void
     */
    public function add(AccessListType $type, string $element): void
    {
        switch ($type) {
            case AccessListType::Address:
                $this->addresses[] = strtolower($element);
                break;
            case AccessListType::Slot:
                $this->slots[] = strtolower($element);
                break;
        }
    }

    /**
     * Check element in list
     *
     * @param AccessListType $type    list type
     * @param string         $element element value
     * @return bool
     */
    public function inList(AccessListType $type, string $element): bool
    {
        $purpose = match ($type) {
            AccessListType::Address => $this->addresses,
            AccessListType::Slot => $this->slots,
        };
        return in_array(strtolower($element), $purpose);
    }
}