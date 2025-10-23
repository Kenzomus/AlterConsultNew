<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node;

<<<<<<< HEAD
use Twig\Attribute\YieldReady;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Compiler;

/**
 * Represents a text node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class TextNode extends Node implements NodeOutputInterface
{
    public function __construct(string $data, int $lineno)
    {
        parent::__construct([], ['data' => $data], $lineno);
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        $compiler->addDebugInfo($this);

        $compiler
            ->write('yield ')
=======
        $compiler
            ->addDebugInfo($this)
            ->write('echo ')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->string($this->getAttribute('data'))
            ->raw(";\n")
        ;
    }
}
