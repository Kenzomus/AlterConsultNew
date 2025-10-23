<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection;

/**
 * Represents a variable.
 *
 *     $var = new Variable('a');
 *
 * will be dumped as
 *
 *     $a
 *
 * by the PHP dumper.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Variable
{
<<<<<<< HEAD
    public function __construct(
        private string $name,
    ) {
=======
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
