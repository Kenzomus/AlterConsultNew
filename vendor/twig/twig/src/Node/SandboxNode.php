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
 * Represents a sandbox node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class SandboxNode extends Node
{
    public function __construct(Node $body, int $lineno)
    {
        parent::__construct(['body' => $body], [], $lineno);
=======
class SandboxNode extends Node
{
    public function __construct(Node $body, int $lineno, string $tag = null)
    {
        parent::__construct(['body' => $body], [], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->addDebugInfo($this)
            ->write("if (!\$alreadySandboxed = \$this->sandbox->isSandboxed()) {\n")
            ->indent()
            ->write("\$this->sandbox->enableSandbox();\n")
            ->outdent()
            ->write("}\n")
            ->write("try {\n")
            ->indent()
            ->subcompile($this->getNode('body'))
            ->outdent()
            ->write("} finally {\n")
            ->indent()
            ->write("if (!\$alreadySandboxed) {\n")
            ->indent()
            ->write("\$this->sandbox->disableSandbox();\n")
            ->outdent()
            ->write("}\n")
            ->outdent()
            ->write("}\n")
        ;
    }
}
