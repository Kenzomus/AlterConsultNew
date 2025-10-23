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

use Symfony\Component\Console\Formatter\NullOutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * NullOutput suppresses all output.
 *
 *     $output = new NullOutput();
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Tobias Schultze <http://tobion.de>
 */
class NullOutput implements OutputInterface
{
    private NullOutputFormatter $formatter;

<<<<<<< HEAD
    public function setFormatter(OutputFormatterInterface $formatter): void
=======
    /**
     * @return void
     */
    public function setFormatter(OutputFormatterInterface $formatter)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        // do nothing
    }

    public function getFormatter(): OutputFormatterInterface
    {
        // to comply with the interface we must return a OutputFormatterInterface
        return $this->formatter ??= new NullOutputFormatter();
    }

<<<<<<< HEAD
    public function setDecorated(bool $decorated): void
=======
    /**
     * @return void
     */
    public function setDecorated(bool $decorated)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        // do nothing
    }

    public function isDecorated(): bool
    {
        return false;
    }

<<<<<<< HEAD
    public function setVerbosity(int $level): void
=======
    /**
     * @return void
     */
    public function setVerbosity(int $level)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        // do nothing
    }

    public function getVerbosity(): int
    {
<<<<<<< HEAD
        return self::VERBOSITY_SILENT;
    }

    public function isSilent(): bool
    {
        return true;
=======
        return self::VERBOSITY_QUIET;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function isQuiet(): bool
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function isVerbose(): bool
    {
        return false;
    }

    public function isVeryVerbose(): bool
    {
        return false;
    }

    public function isDebug(): bool
    {
        return false;
    }

<<<<<<< HEAD
    public function writeln(string|iterable $messages, int $options = self::OUTPUT_NORMAL): void
=======
    /**
     * @return void
     */
    public function writeln(string|iterable $messages, int $options = self::OUTPUT_NORMAL)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        // do nothing
    }

<<<<<<< HEAD
    public function write(string|iterable $messages, bool $newline = false, int $options = self::OUTPUT_NORMAL): void
=======
    /**
     * @return void
     */
    public function write(string|iterable $messages, bool $newline = false, int $options = self::OUTPUT_NORMAL)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        // do nothing
    }
}
