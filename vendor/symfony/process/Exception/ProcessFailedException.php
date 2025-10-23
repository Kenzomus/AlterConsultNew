<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process\Exception;

use Symfony\Component\Process\Process;

/**
 * Exception for failed processes.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ProcessFailedException extends RuntimeException
{
<<<<<<< HEAD
    public function __construct(
        private Process $process,
    ) {
=======
    private Process $process;

    public function __construct(Process $process)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if ($process->isSuccessful()) {
            throw new InvalidArgumentException('Expected a failed process, but the given process was successful.');
        }

        $error = \sprintf('The command "%s" failed.'."\n\nExit Code: %s(%s)\n\nWorking directory: %s",
            $process->getCommandLine(),
            $process->getExitCode(),
            $process->getExitCodeText(),
            $process->getWorkingDirectory()
        );

        if (!$process->isOutputDisabled()) {
            $error .= \sprintf("\n\nOutput:\n================\n%s\n\nError Output:\n================\n%s",
                $process->getOutput(),
                $process->getErrorOutput()
            );
        }

        parent::__construct($error);

        $this->process = $process;
    }

<<<<<<< HEAD
    public function getProcess(): Process
=======
    /**
     * @return Process
     */
    public function getProcess()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->process;
    }
}
