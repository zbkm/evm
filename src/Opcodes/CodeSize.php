<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 *
 * Get size of code running in current environment
 *
 * @note Each instruction occupies one byte. In the case of a PUSH instruction, the bytes that need to be pushed are
 * encoded after that, it thus increases the codesize accordingly.
 */
class CodeSize extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "38";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            Hex::from(count(str_split($this->context->code, 2)))
        );
    }
}