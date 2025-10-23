<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

/**
 * Represents a single backtrace frame as returned by debug_backtrace() or Exception->getTrace().
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class FrameStub extends EnumStub
{
<<<<<<< HEAD
    public function __construct(
        array $frame,
        public bool $keepArgs = true,
        public bool $inTraceStub = false,
    ) {
        parent::__construct($frame);
=======
    public $keepArgs;
    public $inTraceStub;

    public function __construct(array $frame, bool $keepArgs = true, bool $inTraceStub = false)
    {
        $this->value = $frame;
        $this->keepArgs = $keepArgs;
        $this->inTraceStub = $inTraceStub;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
