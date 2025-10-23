<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Output;

/**
 * ConsoleOutputInterface is the interface implemented by ConsoleOutput class.
 * This adds information about stderr and section output stream.
 *
 * @author Dariusz Górecki <darek.krk@gmail.com>
 */
interface ConsoleOutputInterface extends OutputInterface
{
    /**
     * Gets the OutputInterface for errors.
     */
    public function getErrorOutput(): OutputInterface;

<<<<<<< HEAD
    public function setErrorOutput(OutputInterface $error): void;
=======
    /**
     * @return void
     */
    public function setErrorOutput(OutputInterface $error);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function section(): ConsoleSectionOutput;
}
