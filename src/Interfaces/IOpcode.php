<?php
declare(strict_types=1);

namespace Zbkm\Evm\Interfaces;

use Zbkm\Evm\Context;

interface IOpcode
{
    public function __construct(Context $context);

    /**
     * Execute instruction
     *
     * @return void
     */
    public function execute(): void;

    /**
     * Num bytes for skip in calldata
     *
     * @return int
     */
    public function getBytesSkip(): int;

    /**
     * Return spent gas count
     *
     * @return int
     */
    public function getSpentGas(): int;

    /**
     * Return gas refunds count
     *
     * @return int
     */
    public function getRefundGas(): int;

    /**
     * Set additional element (if allowed)
     *
     * @param string $element element value
     * @return void
     */
    public function setElement(string $element): void;

    /**
     * Return opcode name
     *
     * @return string
     */
    static public function getOpcode(): string;

    /**
     * Is instruction stop execution
     *
     * @return bool
     */
    public function isStop(): bool;

    /**
     * Is instruction revert transaction
     *
     * @return bool
     */
    public function isRevert(): bool;

    /**
     * Is instruction jump
     *
     * @return bool
     */
    public function isJump(): bool;

    /**
     * Return position for jump
     *
     * @return int position jump. -1 for not jump instruction
     */
    public function jumpTo(): int;
}