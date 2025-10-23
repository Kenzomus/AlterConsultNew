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
use Twig\Node\Expression\AbstractExpression;

/**
 * Checks if casting an expression to __toString() is allowed by the sandbox.
 *
 * For instance, when there is a simple Print statement, like {{ article }},
 * and if the sandbox is enabled, we need to check that the __toString()
 * method is allowed if 'article' is an object. The same goes for {{ article|upper }}
 * or {{ random(article) }}
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class CheckToStringNode extends AbstractExpression
{
    public function __construct(AbstractExpression $expr)
    {
<<<<<<< HEAD
        parent::__construct(['expr' => $expr], [], $expr->getTemplateLine());
=======
        parent::__construct(['expr' => $expr], [], $expr->getTemplateLine(), $expr->getNodeTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $expr = $this->getNode('expr');
        $compiler
            ->raw('$this->sandbox->ensureToStringAllowed(')
            ->subcompile($expr)
            ->raw(', ')
            ->repr($expr->getTemplateLine())
            ->raw(', $this->source)')
        ;
    }
}
