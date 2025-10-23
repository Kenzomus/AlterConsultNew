<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process\Messenger;

use Symfony\Component\Process\Process;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class RunProcessContext
{
    public readonly ?int $exitCode;
    public readonly ?string $output;
    public readonly ?string $errorOutput;

    public function __construct(
        public readonly RunProcessMessage $message,
        Process $process,
    ) {
        $this->exitCode = $process->getExitCode();
<<<<<<< HEAD
        $this->output = !$process->isStarted() || $process->isOutputDisabled() ? null : $process->getOutput();
        $this->errorOutput = !$process->isStarted() || $process->isOutputDisabled() ? null : $process->getErrorOutput();
=======
        $this->output = $process->isOutputDisabled() ? null : $process->getOutput();
        $this->errorOutput = $process->isOutputDisabled() ? null : $process->getErrorOutput();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
