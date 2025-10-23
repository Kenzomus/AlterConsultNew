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
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Expression\Variable\AssignContextVariable;
=======
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Expression\AssignNameExpression;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Represents a for node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class ForNode extends Node
{
    private $loop;

<<<<<<< HEAD
    public function __construct(AssignContextVariable $keyTarget, AssignContextVariable $valueTarget, AbstractExpression $seq, ?Node $ifexpr, Node $body, ?Node $else, int $lineno)
    {
        $body = new Nodes([$body, $this->loop = new ForLoopNode($lineno)]);

        if (null !== $ifexpr) {
            trigger_deprecation('twig/twig', '3.19', \sprintf('Passing not-null to the "ifexpr" argument of the "%s" constructor is deprecated.', static::class));
        }

        if (null !== $else && !$else instanceof ForElseNode) {
            trigger_deprecation('twig/twig', '3.19', \sprintf('Not passing an instance of "%s" to the "else" argument of the "%s" constructor is deprecated.', ForElseNode::class, static::class));

            $else = new ForElseNode($else, $else->getTemplateLine());
        }
=======
    public function __construct(AssignNameExpression $keyTarget, AssignNameExpression $valueTarget, AbstractExpression $seq, ?Node $ifexpr, Node $body, ?Node $else, int $lineno, string $tag = null)
    {
        $body = new Node([$body, $this->loop = new ForLoopNode($lineno, $tag)]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $nodes = ['key_target' => $keyTarget, 'value_target' => $valueTarget, 'seq' => $seq, 'body' => $body];
        if (null !== $else) {
            $nodes['else'] = $else;
        }

<<<<<<< HEAD
        parent::__construct($nodes, ['with_loop' => true], $lineno);
=======
        parent::__construct($nodes, ['with_loop' => true], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->addDebugInfo($this)
            ->write("\$context['_parent'] = \$context;\n")
<<<<<<< HEAD
            ->write("\$context['_seq'] = CoreExtension::ensureTraversable(")
=======
            ->write("\$context['_seq'] = twig_ensure_traversable(")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->subcompile($this->getNode('seq'))
            ->raw(");\n")
        ;

        if ($this->hasNode('else')) {
            $compiler->write("\$context['_iterated'] = false;\n");
        }

        if ($this->getAttribute('with_loop')) {
            $compiler
                ->write("\$context['loop'] = [\n")
                ->write("  'parent' => \$context['_parent'],\n")
                ->write("  'index0' => 0,\n")
                ->write("  'index'  => 1,\n")
                ->write("  'first'  => true,\n")
                ->write("];\n")
                ->write("if (is_array(\$context['_seq']) || (is_object(\$context['_seq']) && \$context['_seq'] instanceof \Countable)) {\n")
                ->indent()
                ->write("\$length = count(\$context['_seq']);\n")
                ->write("\$context['loop']['revindex0'] = \$length - 1;\n")
                ->write("\$context['loop']['revindex'] = \$length;\n")
                ->write("\$context['loop']['length'] = \$length;\n")
                ->write("\$context['loop']['last'] = 1 === \$length;\n")
                ->outdent()
                ->write("}\n")
            ;
        }

        $this->loop->setAttribute('else', $this->hasNode('else'));
        $this->loop->setAttribute('with_loop', $this->getAttribute('with_loop'));

        $compiler
            ->write("foreach (\$context['_seq'] as ")
            ->subcompile($this->getNode('key_target'))
            ->raw(' => ')
            ->subcompile($this->getNode('value_target'))
            ->raw(") {\n")
            ->indent()
            ->subcompile($this->getNode('body'))
            ->outdent()
            ->write("}\n")
        ;

        if ($this->hasNode('else')) {
<<<<<<< HEAD
            $compiler->subcompile($this->getNode('else'));
=======
            $compiler
                ->write("if (!\$context['_iterated']) {\n")
                ->indent()
                ->subcompile($this->getNode('else'))
                ->outdent()
                ->write("}\n")
            ;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $compiler->write("\$_parent = \$context['_parent'];\n");

        // remove some "private" loop variables (needed for nested loops)
<<<<<<< HEAD
        $compiler->write('unset($context[\'_seq\'], $context[\''.$this->getNode('key_target')->getAttribute('name').'\'], $context[\''.$this->getNode('value_target')->getAttribute('name').'\'], $context[\'_parent\']');
        if ($this->hasNode('else')) {
            $compiler->raw(', $context[\'_iterated\']');
        }
        if ($this->getAttribute('with_loop')) {
            $compiler->raw(', $context[\'loop\']');
        }
        $compiler->raw(");\n");
=======
        $compiler->write('unset($context[\'_seq\'], $context[\'_iterated\'], $context[\''.$this->getNode('key_target')->getAttribute('name').'\'], $context[\''.$this->getNode('value_target')->getAttribute('name').'\'], $context[\'_parent\'], $context[\'loop\']);'."\n");
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        // keep the values set in the inner context for variables defined in the outer context
        $compiler->write("\$context = array_intersect_key(\$context, \$_parent) + \$_parent;\n");
    }
}
