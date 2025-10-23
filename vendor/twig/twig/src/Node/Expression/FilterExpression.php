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

namespace Twig\Node\Expression;

<<<<<<< HEAD
use Twig\Attribute\FirstClassTwigCallableReady;
use Twig\Compiler;
use Twig\Node\NameDeprecation;
use Twig\Node\Node;
use Twig\TwigFilter;

class FilterExpression extends CallExpression
{
    /**
     * @param AbstractExpression $node
     */
    #[FirstClassTwigCallableReady]
    public function __construct(Node $node, TwigFilter|ConstantExpression $filter, Node $arguments, int $lineno)
    {
        if (!$node instanceof AbstractExpression) {
            trigger_deprecation('twig/twig', '3.15', 'Not passing a "%s" instance to the "node" argument of "%s" is deprecated ("%s" given).', AbstractExpression::class, static::class, $node::class);
        }

        if ($filter instanceof TwigFilter) {
            $name = $filter->getName();
            $filterName = new ConstantExpression($name, $lineno);
        } else {
            $name = $filter->getAttribute('value');
            $filterName = $filter;
            trigger_deprecation('twig/twig', '3.12', 'Not passing an instance of "TwigFilter" when creating a "%s" filter of type "%s" is deprecated.', $name, static::class);
        }

        parent::__construct(['node' => $node, 'filter' => $filterName, 'arguments' => $arguments], ['name' => $name, 'type' => 'filter'], $lineno);

        if ($filter instanceof TwigFilter) {
            $this->setAttribute('twig_callable', $filter);
        }

        $this->deprecateNode('filter', new NameDeprecation('twig/twig', '3.12'));

        $this->deprecateAttribute('needs_charset', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('needs_environment', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('needs_context', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('arguments', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('callable', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('is_variadic', new NameDeprecation('twig/twig', '3.12'));
        $this->deprecateAttribute('dynamic_name', new NameDeprecation('twig/twig', '3.12'));
=======
use Twig\Compiler;
use Twig\Node\Node;

class FilterExpression extends CallExpression
{
    public function __construct(Node $node, ConstantExpression $filterName, Node $arguments, int $lineno, string $tag = null)
    {
        parent::__construct(['node' => $node, 'filter' => $filterName, 'arguments' => $arguments], [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        $name = $this->getNode('filter', false)->getAttribute('value');
        if ($name !== $this->getAttribute('name')) {
            trigger_deprecation('twig/twig', '3.11', 'Changing the value of a "filter" node in a NodeVisitor class is not supported anymore.');
            $this->removeAttribute('twig_callable');
        }
        if ('raw' === $name) {
            trigger_deprecation('twig/twig', '3.11', 'Creating the "raw" filter via "FilterExpression" is deprecated; use "RawFilter" instead.');

            $compiler->subcompile($this->getNode('node'));

            return;
        }

        if (!$this->hasAttribute('twig_callable')) {
            $this->setAttribute('twig_callable', $compiler->getEnvironment()->getFilter($name));
        }
=======
        $name = $this->getNode('filter')->getAttribute('value');
        $filter = $compiler->getEnvironment()->getFilter($name);

        $this->setAttribute('name', $name);
        $this->setAttribute('type', 'filter');
        $this->setAttribute('needs_environment', $filter->needsEnvironment());
        $this->setAttribute('needs_context', $filter->needsContext());
        $this->setAttribute('arguments', $filter->getArguments());
        $this->setAttribute('callable', $filter->getCallable());
        $this->setAttribute('is_variadic', $filter->isVariadic());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $this->compileCallable($compiler);
    }
}
