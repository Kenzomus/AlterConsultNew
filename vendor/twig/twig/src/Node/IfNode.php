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
use Twig\Node\Expression\ReturnPrimitiveTypeInterface;
use Twig\Node\Expression\Test\TrueTest;
use Twig\TwigTest;
=======
use Twig\Compiler;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Represents an if node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class IfNode extends Node
{
    public function __construct(Node $tests, ?Node $else, int $lineno)
    {
        for ($i = 0, $count = \count($tests); $i < $count; $i += 2) {
            $test = $tests->getNode((string) $i);
            if (!$test instanceof ReturnPrimitiveTypeInterface) {
                $tests->setNode($i, new TrueTest($test, new TwigTest('true'), null, $test->getTemplateLine()));
            }
        }
=======
class IfNode extends Node
{
    public function __construct(Node $tests, ?Node $else, int $lineno, string $tag = null)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $nodes = ['tests' => $tests];
        if (null !== $else) {
            $nodes['else'] = $else;
        }

<<<<<<< HEAD
        parent::__construct($nodes, [], $lineno);
=======
        parent::__construct($nodes, [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler->addDebugInfo($this);
        for ($i = 0, $count = \count($this->getNode('tests')); $i < $count; $i += 2) {
            if ($i > 0) {
                $compiler
                    ->outdent()
                    ->write('} elseif (')
                ;
            } else {
                $compiler
                    ->write('if (')
                ;
            }

            $compiler
<<<<<<< HEAD
                ->subcompile($this->getNode('tests')->getNode((string) $i))
=======
                ->subcompile($this->getNode('tests')->getNode($i))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->raw(") {\n")
                ->indent()
            ;
            // The node might not exists if the content is empty
<<<<<<< HEAD
            if ($this->getNode('tests')->hasNode((string) ($i + 1))) {
                $compiler->subcompile($this->getNode('tests')->getNode((string) ($i + 1)));
=======
            if ($this->getNode('tests')->hasNode($i + 1)) {
                $compiler->subcompile($this->getNode('tests')->getNode($i + 1));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        if ($this->hasNode('else')) {
            $compiler
                ->outdent()
                ->write("} else {\n")
                ->indent()
                ->subcompile($this->getNode('else'))
            ;
        }

        $compiler
            ->outdent()
            ->write("}\n");
    }
}
