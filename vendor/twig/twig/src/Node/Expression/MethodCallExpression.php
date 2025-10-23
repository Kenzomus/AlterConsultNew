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
use Twig\Node\Expression\Variable\ContextVariable;

class MethodCallExpression extends AbstractExpression implements SupportDefinedTestInterface
{
    use SupportDefinedTestDeprecationTrait;
    use SupportDefinedTestTrait;

    public function __construct(AbstractExpression $node, string $method, ArrayExpression $arguments, int $lineno)
    {
        trigger_deprecation('twig/twig', '3.15', 'The "%s" class is deprecated, use "%s" instead.', __CLASS__, MacroReferenceExpression::class);

        parent::__construct(['node' => $node, 'arguments' => $arguments], ['method' => $method, 'safe' => false], $lineno);

        if ($node instanceof ContextVariable) {
=======

class MethodCallExpression extends AbstractExpression
{
    public function __construct(AbstractExpression $node, string $method, ArrayExpression $arguments, int $lineno)
    {
        parent::__construct(['node' => $node, 'arguments' => $arguments], ['method' => $method, 'safe' => false, 'is_defined_test' => false], $lineno);

        if ($node instanceof NameExpression) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $node->setAttribute('always_defined', true);
        }
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        if ($this->definedTest) {
=======
        if ($this->getAttribute('is_defined_test')) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $compiler
                ->raw('method_exists($macros[')
                ->repr($this->getNode('node')->getAttribute('name'))
                ->raw('], ')
                ->repr($this->getAttribute('method'))
                ->raw(')')
            ;

            return;
        }

        $compiler
<<<<<<< HEAD
            ->raw('CoreExtension::callMacro($macros[')
            ->repr($this->getNode('node')->getAttribute('name'))
            ->raw('], ')
            ->repr($this->getAttribute('method'))
            ->raw(', ')
            ->subcompile($this->getNode('arguments'))
            ->raw(', ')
=======
            ->raw('twig_call_macro($macros[')
            ->repr($this->getNode('node')->getAttribute('name'))
            ->raw('], ')
            ->repr($this->getAttribute('method'))
            ->raw(', [')
        ;
        $first = true;
        foreach ($this->getNode('arguments')->getKeyValuePairs() as $pair) {
            if (!$first) {
                $compiler->raw(', ');
            }
            $first = false;

            $compiler->subcompile($pair['value']);
        }
        $compiler
            ->raw('], ')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->repr($this->getTemplateLine())
            ->raw(', $context, $this->getSourceContext())');
    }
}
