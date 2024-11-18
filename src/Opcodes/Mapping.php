<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Exceptions\InvalidOpcode;
use Zbkm\Evm\Interfaces\IOpcode;

class Mapping
{
    /**
     * @param string $opcode opcode
     * @return class-string<IOpcode>
     */
    public static function getExecutor(string $opcode): string
    {
        if (!array_key_exists($opcode, self::getOpcodeMapping())) {
            throw new InvalidOpcode();
        }

        return self::getOpcodeMapping()[$opcode];
    }

    /**
     * Return mapping for opcodes
     *
     * @return array<string, string>
     */
    public static function getOpcodeMapping(): array
    {
        return [
            "00" => Stop::class,
            "01" => Add::class,
            "02" => Mul::class,
            "03" => Sub::class,
            "04" => Div::class,
            "05" => Sdiv::class,
            "06" => Mod::class,
            "07" => Smod::class,
            "08" => Addmod::class,
            "09" => Mulmod::class,
            "0A" => Exp::class,

            "60" => Push1::class
        ];
    }

}