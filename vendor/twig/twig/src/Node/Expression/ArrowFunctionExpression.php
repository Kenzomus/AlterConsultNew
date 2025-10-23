<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node\Expression;

use Twig\Compiler;
<<<<<<< HEAD
use Twig\Error\SyntaxError;
use Twig\Node\Expression\Variable\AssignContextVariable;
use Twig\Node\Expression\Variable\ContextVariable;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\Node;

/**
 * Represents an arrow function.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ArrowFunctionExpression extends AbstractExpression
{
<<<<<<< HEAD
    public function __construct(AbstractExpression $expr, Node $names, $lineno)
    {
        if (!$names instanceof ListExpression && !$names instanceof ContextVariable) {
            throw new SyntaxError('The arrow function argument must be a list of variables or a single variable.', $names->getTemplateLine(), $names->getSourceContext());
        }

        if ($names instanceof ContextVariable) {
            $names = new ListExpression([new AssignContextVariable($names->getAttribute('name'), $names->getTemplateLine())], $lineno);
        }

        parent::__construct(['expr' => $expr, 'names' => $names], [], $lineno);
=======
    public function __construct(AbstractExpression $expr, Node $names, $lineno, $tag = null)
    {
        parent::__construct(['expr' => $expr, 'names' => $names], [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->addDebugInfo($this)
            ->raw('function (')
<<<<<<< HEAD
            ->subcompile($this->getNode('names'))
=======
        ;
        foreach ($this->getNode('names') as $i => $name) {
            if ($i) {
                $compiler->raw(', ');
            }

            $compiler
                ->raw('$__')
                ->raw($name->getAttribute('name'))
                ->raw('__')
            ;
        }
        $compiler
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->raw(') use ($context, $macros) { ')
        ;
        foreach ($this->getNode('names') as $name) {
            $compiler
                ->raw('$context["')
                ->raw($name->getAttribute('name'))
                ->raw('"] = $__')
                ->raw($name->getAttribute('name'))
                ->raw('__; ')
            ;
        }
        $compiler
            ->raw('return ')
            ->subcompile($this->getNode('expr'))
            ->raw('; }')
        ;
    }
}
