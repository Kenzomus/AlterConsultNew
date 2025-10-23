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

/**
 * Represents a nested "with" scope.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class WithNode extends Node
{
    public function __construct(Node $body, ?Node $variables, bool $only, int $lineno)
=======
class WithNode extends Node
{
    public function __construct(Node $body, ?Node $variables, bool $only, int $lineno, string $tag = null)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $nodes = ['body' => $body];
        if (null !== $variables) {
            $nodes['variables'] = $variables;
        }

<<<<<<< HEAD
        parent::__construct($nodes, ['only' => $only], $lineno);
=======
        parent::__construct($nodes, ['only' => $only], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);

        $parentContextName = $compiler->getVarName();

<<<<<<< HEAD
        $compiler->write(\sprintf("\$%s = \$context;\n", $parentContextName));
=======
        $compiler->write(sprintf("\$%s = \$context;\n", $parentContextName));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        if ($this->hasNode('variables')) {
            $node = $this->getNode('variables');
            $varsName = $compiler->getVarName();
            $compiler
<<<<<<< HEAD
                ->write(\sprintf('$%s = ', $varsName))
                ->subcompile($node)
                ->raw(";\n")
                ->write(\sprintf("if (!is_iterable(\$%s)) {\n", $varsName))
                ->indent()
                ->write("throw new RuntimeError('Variables passed to the \"with\" tag must be a mapping.', ")
=======
                ->write(sprintf('$%s = ', $varsName))
                ->subcompile($node)
                ->raw(";\n")
                ->write(sprintf("if (!is_iterable(\$%s)) {\n", $varsName))
                ->indent()
                ->write("throw new RuntimeError('Variables passed to the \"with\" tag must be a hash.', ")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->repr($node->getTemplateLine())
                ->raw(", \$this->getSourceContext());\n")
                ->outdent()
                ->write("}\n")
<<<<<<< HEAD
                ->write(\sprintf("\$%s = CoreExtension::toArray(\$%s);\n", $varsName, $varsName))
=======
                ->write(sprintf("\$%s = twig_to_array(\$%s);\n", $varsName, $varsName))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ;

            if ($this->getAttribute('only')) {
                $compiler->write("\$context = [];\n");
            }

<<<<<<< HEAD
            $compiler->write(\sprintf("\$context = \$%s + \$context + \$this->env->getGlobals();\n", $varsName));
=======
            $compiler->write(sprintf("\$context = \$this->env->mergeGlobals(array_merge(\$context, \$%s));\n", $varsName));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $compiler
            ->subcompile($this->getNode('body'))
<<<<<<< HEAD
            ->write(\sprintf("\$context = \$%s;\n", $parentContextName))
=======
            ->write(sprintf("\$context = \$%s;\n", $parentContextName))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ;
    }
}
