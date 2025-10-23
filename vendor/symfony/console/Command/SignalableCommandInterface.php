<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Command;

/**
 * Interface for command reacting to signal.
 *
 * @author Grégoire Pineau <lyrixx@lyrix.info>
 */
interface SignalableCommandInterface
{
    /**
     * Returns the list of signals to subscribe.
     */
    public function getSubscribedSignals(): array;

    /**
     * The method will be called when the application is signaled.
     *
<<<<<<< HEAD
     * @return int|false The exit code to return or false to continue the normal execution
     */
    public function handleSignal(int $signal, int|false $previousExitCode = 0): int|false;
=======
     * @param int|false $previousExitCode
     *
     * @return int|false The exit code to return or false to continue the normal execution
     */
    public function handleSignal(int $signal/* , int|false $previousExitCode = 0 */);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
