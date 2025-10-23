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
use Twig\Node\Expression\ConstantExpression;

/**
 * Represents a set node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class SetNode extends Node implements NodeCaptureInterface
{
    public function __construct(bool $capture, Node $names, Node $values, int $lineno)
    {
=======
class SetNode extends Node implements NodeCaptureInterface
{
    public function __construct(bool $capture, Node $names, Node $values, int $lineno, string $tag = null)
    {
        parent::__construct(['names' => $names, 'values' => $values], ['capture' => $capture, 'safe' => false], $lineno, $tag);

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        /*
         * Optimizes the node when capture is used for a large block of text.
         *
         * {% set foo %}foo{% endset %} is compiled to $context['foo'] = new Twig\Markup("foo");
         */
<<<<<<< HEAD
        $safe = false;
        if ($capture) {
            $safe = true;
            // Node::class === get_class($values) should be removed in Twig 4.0
            if (($values instanceof Nodes || Node::class === $values::class) && !\count($values)) {
                $values = new ConstantExpression('', $values->getTemplateLine());
                $capture = false;
            } elseif ($values instanceof TextNode) {
                $values = new ConstantExpression($values->getAttribute('data'), $values->getTemplateLine());
                $capture = false;
            } elseif ($values instanceof PrintNode && $values->getNode('expr') instanceof ConstantExpression) {
                $values = $values->getNode('expr');
                $capture = false;
            } else {
                $values = new CaptureNode($values, $values->getTemplateLine());
            }
        }

        parent::__construct(['names' => $names, 'values' => $values], ['capture' => $capture, 'safe' => $safe], $lineno);
=======
        if ($this->getAttribute('capture')) {
            $this->setAttribute('safe', true);

            $values = $this->getNode('values');
            if ($values instanceof TextNode) {
                $this->setNode('values', new ConstantExpression($values->getAttribute('data'), $values->getTemplateLine()));
                $this->setAttribute('capture', false);
            }
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);

        if (\count($this->getNode('names')) > 1) {
<<<<<<< HEAD
            $compiler->write('[');
=======
            $compiler->write('list(');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            foreach ($this->getNode('names') as $idx => $node) {
                if ($idx) {
                    $compiler->raw(', ');
                }

                $compiler->subcompile($node);
            }
<<<<<<< HEAD
            $compiler->raw(']');
        } else {
            $compiler->subcompile($this->getNode('names'), false);
        }
        $compiler->raw(' = ');

        if ($this->getAttribute('capture')) {
            $compiler->subcompile($this->getNode('values'));
        } else {
=======
            $compiler->raw(')');
        } else {
            if ($this->getAttribute('capture')) {
                if ($compiler->getEnvironment()->isDebug()) {
                    $compiler->write("ob_start();\n");
                } else {
                    $compiler->write("ob_start(function () { return ''; });\n");
                }
                $compiler
                    ->subcompile($this->getNode('values'))
                ;
            }

            $compiler->subcompile($this->getNode('names'), false);

            if ($this->getAttribute('capture')) {
                $compiler->raw(" = ('' === \$tmp = ob_get_clean()) ? '' : new Markup(\$tmp, \$this->env->getCharset())");
            }
        }

        if (!$this->getAttribute('capture')) {
            $compiler->raw(' = ');

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if (\count($this->getNode('names')) > 1) {
                $compiler->write('[');
                foreach ($this->getNode('values') as $idx => $value) {
                    if ($idx) {
                        $compiler->raw(', ');
                    }

                    $compiler->subcompile($value);
                }
                $compiler->raw(']');
            } else {
                if ($this->getAttribute('safe')) {
<<<<<<< HEAD
                    if ($this->getNode('values') instanceof ConstantExpression) {
                        if ('' === $this->getNode('values')->getAttribute('value')) {
                            $compiler->raw('""');
                        } else {
                            $compiler
                                ->raw('new Markup(')
                                ->subcompile($this->getNode('values'))
                                ->raw(', $this->env->getCharset())')
                            ;
                        }
                    } else {
                        $compiler
                            ->raw("('' === \$tmp = ")
                            ->subcompile($this->getNode('values'))
                            ->raw(") ? '' : new Markup(\$tmp, \$this->env->getCharset())")
                        ;
                    }
=======
                    $compiler
                        ->raw("('' === \$tmp = ")
                        ->subcompile($this->getNode('values'))
                        ->raw(") ? '' : new Markup(\$tmp, \$this->env->getCharset())")
                    ;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                } else {
                    $compiler->subcompile($this->getNode('values'));
                }
            }
<<<<<<< HEAD

            $compiler->raw(';');
        }

        $compiler->raw("\n");
=======
        }

        $compiler->raw(";\n");
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
