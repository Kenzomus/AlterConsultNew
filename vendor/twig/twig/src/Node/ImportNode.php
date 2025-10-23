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
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Expression\Variable\AssignTemplateVariable;
use Twig\Node\Expression\Variable\ContextVariable;
=======
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Expression\NameExpression;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Represents an import node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class ImportNode extends Node
{
    public function __construct(AbstractExpression $expr, AbstractExpression|AssignTemplateVariable $var, int $lineno)
    {
        if (\func_num_args() > 3) {
            trigger_deprecation('twig/twig', '3.15', \sprintf('Passing more than 3 arguments to "%s()" is deprecated.', __METHOD__));
        }

        if (!$var instanceof AssignTemplateVariable) {
            trigger_deprecation('twig/twig', '3.15', \sprintf('Passing a "%s" instance as the second argument of "%s" is deprecated, pass a "%s" instead.', $var::class, __CLASS__, AssignTemplateVariable::class));

            $var = new AssignTemplateVariable($var->getAttribute('name'), $lineno);
        }

        parent::__construct(['expr' => $expr, 'var' => $var], [], $lineno);
=======
class ImportNode extends Node
{
    public function __construct(AbstractExpression $expr, AbstractExpression $var, int $lineno, string $tag = null, bool $global = true)
    {
        parent::__construct(['expr' => $expr, 'var' => $var], ['global' => $global], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        $compiler->subcompile($this->getNode('var'));

        if ($this->getNode('expr') instanceof ContextVariable && '_self' === $this->getNode('expr')->getAttribute('name')) {
            $compiler->raw('$this');
        } else {
            $compiler
                ->raw('$this->load(')
                ->subcompile($this->getNode('expr'))
                ->raw(', ')
=======
        $compiler
            ->addDebugInfo($this)
            ->write('$macros[')
            ->repr($this->getNode('var')->getAttribute('name'))
            ->raw('] = ')
        ;

        if ($this->getAttribute('global')) {
            $compiler
                ->raw('$this->macros[')
                ->repr($this->getNode('var')->getAttribute('name'))
                ->raw('] = ')
            ;
        }

        if ($this->getNode('expr') instanceof NameExpression && '_self' === $this->getNode('expr')->getAttribute('name')) {
            $compiler->raw('$this');
        } else {
            $compiler
                ->raw('$this->loadTemplate(')
                ->subcompile($this->getNode('expr'))
                ->raw(', ')
                ->repr($this->getTemplateName())
                ->raw(', ')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->repr($this->getTemplateLine())
                ->raw(')->unwrap()')
            ;
        }

        $compiler->raw(";\n");
    }
}
