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

class EndsWithBinary extends AbstractBinary implements ReturnBoolInterface
=======

class EndsWithBinary extends AbstractBinary
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
{
    public function compile(Compiler $compiler): void
    {
        $left = $compiler->getVarName();
        $right = $compiler->getVarName();
        $compiler
<<<<<<< HEAD
            ->raw(\sprintf('(is_string($%s = ', $left))
            ->subcompile($this->getNode('left'))
            ->raw(\sprintf(') && is_string($%s = ', $right))
            ->subcompile($this->getNode('right'))
            ->raw(\sprintf(') && str_ends_with($%1$s, $%2$s))', $left, $right))
=======
            ->raw(sprintf('(is_string($%s = ', $left))
            ->subcompile($this->getNode('left'))
            ->raw(sprintf(') && is_string($%s = ', $right))
            ->subcompile($this->getNode('right'))
            ->raw(sprintf(') && str_ends_with($%1$s, $%2$s))', $left, $right))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ;
    }

    public function operator(Compiler $compiler): Compiler
    {
        return $compiler->raw('');
    }
}
