<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Exceptions\InvalidOpcode;
use Zbkm\Evm\Interfaces\IOpcode;

/**
 * Mapping for opcodes
 */
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
            "0B" => SignExtend::class,
            "10" => Lt::class,
            "11" => Gt::class,
            "12" => Slt::class,
            "13" => Sgt::class,
            "14" => Eq::class,
            "15" => IsZero::class,
            "16" => AndBit::class,
            "17" => OrBit::class,
            "18" => XorBit::class,
            "19" => Not::class,
            "1A" => Byte::class,
            "1B" => Shl::class,
            "1C" => Shr::class,
            "1D" => Sar::class,
            "20" => Keccak256::class,
            "30" => Address::class,
            "31" => Balance::class,
            "32" => Origin::class,
            "33" => Caller::class,
            "34" => CallValue::class,
            "35" => CallDataLoad::class,
            "36" => CallDataSize::class,
            "37" => CallDataCopy::class,
            "38" => CodeSize::class,
            "39" => CodeCopy::class,
            "3A" => GasPrice::class,
            "3B" => ExtCodeSize::class,
            "3C" => ExtCodeCopy::class,
            // "3D" => ReturnDataSize::class,
            // "3E" => ReturnDataCopy::class,
            "3F" => ExtCodeHash::class,
            "40" => BlockHash::class,
            "41" => Coinbase::class,
            "42" => Timestamp::class,
            "43" => Number::class,
            "44" => PrevRandao::class,
            "45" => GasLimit::class,
            "46" => ChainId::class,
            "47" => SelfBalance::class,
            "48" => BaseFee::class,
            "49" => BlobHash::class,
            "4A" => BlobBaseFee::class,
            "50" => Pop::class,
            "51" => MLoad::class,
            "52" => MStore::class,
            "53" => MStore8::class,
            "54" => SLoad::class,
            "55" => SStore::class,
            "56" => Jump::class,
            "57" => JumpI::class,
            // "58" => PC::class,
            // "59" => MSize::class,
            // "5A" => Gas::class,
            "5B" => JumpDest::class,

            "60" => Push1::class
        ];
    }

}