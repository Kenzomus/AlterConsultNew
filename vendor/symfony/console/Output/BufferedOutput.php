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
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class BufferedOutput extends Output
{
    private string $buffer = '';

    /**
     * Empties buffer and returns its content.
     */
    public function fetch(): string
    {
        $content = $this->buffer;
        $this->buffer = '';

        return $content;
    }

<<<<<<< HEAD
    protected function doWrite(string $message, bool $newline): void
=======
    /**
     * @return void
     */
    protected function doWrite(string $message, bool $newline)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->buffer .= $message;

        if ($newline) {
            $this->buffer .= \PHP_EOL;
        }
    }
}
