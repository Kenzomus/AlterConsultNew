<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
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
 * Represents a flush node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class FlushNode extends Node
{
    public function __construct(int $lineno)
    {
        parent::__construct([], [], $lineno);
=======
class FlushNode extends Node
{
    public function __construct(int $lineno, string $tag)
    {
        parent::__construct([], [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        $compiler->addDebugInfo($this);

        if ($compiler->getEnvironment()->useYield()) {
            $compiler->write("yield '';\n");
        }

        $compiler->write("flush();\n");
=======
        $compiler
            ->addDebugInfo($this)
            ->write("flush();\n")
        ;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
