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
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Compiler;

/**
 * Represents a block node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class BlockNode extends Node
{
    public function __construct(string $name, Node $body, int $lineno)
    {
        parent::__construct(['body' => $body], ['name' => $name], $lineno);
=======
class BlockNode extends Node
{
    public function __construct(string $name, Node $body, int $lineno, string $tag = null)
    {
        parent::__construct(['body' => $body], ['name' => $name], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->addDebugInfo($this)
<<<<<<< HEAD
            ->write("/**\n")
            ->write(" * @return iterable<null|scalar|\Stringable>\n")
            ->write(" */\n")
            ->write(\sprintf("public function block_%s(array \$context, array \$blocks = []): iterable\n", $this->getAttribute('name')), "{\n")
=======
            ->write(sprintf("public function block_%s(\$context, array \$blocks = [])\n", $this->getAttribute('name')), "{\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->indent()
            ->write("\$macros = \$this->macros;\n")
        ;

        $compiler
            ->subcompile($this->getNode('body'))
<<<<<<< HEAD
            ->write("yield from [];\n")
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->outdent()
            ->write("}\n\n")
        ;
    }
}
