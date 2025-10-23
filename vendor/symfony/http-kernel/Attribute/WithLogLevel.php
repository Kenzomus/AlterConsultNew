<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Attribute;

use Psr\Log\LogLevel;

/**
<<<<<<< HEAD
 * Defines the log level applied to an exception.
 *
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Dejan Angelov <angelovdejan@protonmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class WithLogLevel
{
    /**
<<<<<<< HEAD
     * @param LogLevel::* $level The level to use to log the exception
=======
     * @param LogLevel::* $level
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function __construct(public readonly string $level)
    {
        if (!\defined('Psr\Log\LogLevel::'.strtoupper($this->level))) {
            throw new \InvalidArgumentException(\sprintf('Invalid log level "%s".', $this->level));
        }
    }
}
