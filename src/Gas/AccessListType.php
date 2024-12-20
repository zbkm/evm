<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

/**
 * AccessList types
 */
enum AccessListType
{
    case Address;
    case Slot;
}