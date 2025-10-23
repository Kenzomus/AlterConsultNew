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

namespace Twig\Node\Expression\Unary;

use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Node;

<<<<<<< HEAD
abstract class AbstractUnary extends AbstractExpression implements UnaryInterface
{
    /**
     * @param AbstractExpression $node
     */
    public function __construct(Node $node, int $lineno)
    {
        if (!$node instanceof AbstractExpression) {
            trigger_deprecation('twig/twig', '3.15', 'Not passing a "%s" instance argument to "%s" is deprecated ("%s" given).', AbstractExpression::class, static::class, $node::class);
        }

        parent::__construct(['node' => $node], ['with_parentheses' => false], $lineno);
=======
abstract class AbstractUnary extends AbstractExpression
{
    public function __construct(Node $node, int $lineno)
    {
        parent::__construct(['node' => $node], [], $lineno);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        if ($this->hasExplicitParentheses()) {
            $compiler->raw('(');
        } else {
            $compiler->raw(' ');
        }
        $this->operator($compiler);
        $compiler->subcompile($this->getNode('node'));
        if ($this->hasExplicitParentheses()) {
            $compiler->raw(')');
        }
=======
        $compiler->raw(' ');
        $this->operator($compiler);
        $compiler->subcompile($this->getNode('node'));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    abstract public function operator(Compiler $compiler): Compiler;
}
