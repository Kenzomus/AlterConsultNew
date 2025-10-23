<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node\Expression\Binary;

use Twig\Compiler;
<<<<<<< HEAD
use Twig\Node\Expression\ReturnBoolInterface;

class InBinary extends AbstractBinary implements ReturnBoolInterface
=======

class InBinary extends AbstractBinary
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
{
    public function compile(Compiler $compiler): void
    {
        $compiler
<<<<<<< HEAD
            ->raw('CoreExtension::inFilter(')
=======
            ->raw('twig_in_filter(')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw(')')
        ;
    }

    public function operator(Compiler $compiler): Compiler
    {
        return $compiler->raw('in');
    }
}
