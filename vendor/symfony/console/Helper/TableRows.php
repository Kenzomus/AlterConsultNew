<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

/**
 * @internal
 */
class TableRows implements \IteratorAggregate
{
<<<<<<< HEAD
    public function __construct(
        private \Closure $generator,
    ) {
=======
    private \Closure $generator;

    public function __construct(\Closure $generator)
    {
        $this->generator = $generator;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getIterator(): \Traversable
    {
        return ($this->generator)();
    }
}
