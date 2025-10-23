<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Profiler\Node;

<<<<<<< HEAD
use Twig\Attribute\YieldReady;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Compiler;
use Twig\Node\Node;

/**
 * Represents a profile leave node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class LeaveProfileNode extends Node
{
    public function __construct(string $varName)
    {
        parent::__construct([], ['var_name' => $varName]);
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->write("\n")
<<<<<<< HEAD
            ->write(\sprintf("\$%s->leave(\$%s);\n\n", $this->getAttribute('var_name'), $this->getAttribute('var_name').'_prof'))
=======
            ->write(sprintf("\$%s->leave(\$%s);\n\n", $this->getAttribute('var_name'), $this->getAttribute('var_name').'_prof'))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ;
    }
}
