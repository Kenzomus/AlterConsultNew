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
use Twig\Node\Expression\ConstantExpression;

/**
 * Represents a deprecated node.
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
<<<<<<< HEAD
#[YieldReady]
class DeprecatedNode extends Node
{
    public function __construct(AbstractExpression $expr, int $lineno)
    {
        parent::__construct(['expr' => $expr], [], $lineno);
=======
class DeprecatedNode extends Node
{
    public function __construct(AbstractExpression $expr, int $lineno, string $tag = null)
    {
        parent::__construct(['expr' => $expr], [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);

        $expr = $this->getNode('expr');

<<<<<<< HEAD
        if (!$expr instanceof ConstantExpression) {
            $varName = $compiler->getVarName();
            $compiler
                ->write(\sprintf('$%s = ', $varName))
                ->subcompile($expr)
                ->raw(";\n")
            ;
        }

        $compiler->write('trigger_deprecation(');
        if ($this->hasNode('package')) {
            $compiler->subcompile($this->getNode('package'));
        } else {
            $compiler->raw("''");
        }
        $compiler->raw(', ');
        if ($this->hasNode('version')) {
            $compiler->subcompile($this->getNode('version'));
        } else {
            $compiler->raw("''");
        }
        $compiler->raw(', ');

        if ($expr instanceof ConstantExpression) {
            $compiler->subcompile($expr);
        } else {
            $compiler->write(\sprintf('$%s', $varName));
=======
        if ($expr instanceof ConstantExpression) {
            $compiler->write('@trigger_error(')
                ->subcompile($expr);
        } else {
            $varName = $compiler->getVarName();
            $compiler->write(sprintf('$%s = ', $varName))
                ->subcompile($expr)
                ->raw(";\n")
                ->write(sprintf('@trigger_error($%s', $varName));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $compiler
            ->raw('.')
<<<<<<< HEAD
            ->string(\sprintf(' in "%s" at line %d.', $this->getTemplateName(), $this->getTemplateLine()))
            ->raw(");\n")
=======
            ->string(sprintf(' ("%s" at line %d).', $this->getTemplateName(), $this->getTemplateLine()))
            ->raw(", E_USER_DEPRECATED);\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ;
    }
}
