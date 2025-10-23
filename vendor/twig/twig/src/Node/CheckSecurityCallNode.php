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
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class CheckSecurityCallNode extends Node
{
    /**
     * @return void
     */
    public function compile(Compiler $compiler)
    {
        $compiler
            ->write("\$this->sandbox = \$this->extensions[SandboxExtension::class];\n")
=======
class CheckSecurityCallNode extends Node
{
    public function compile(Compiler $compiler)
    {
        $compiler
            ->write("\$this->sandbox = \$this->env->getExtension('\Twig\Extension\SandboxExtension');\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->write("\$this->checkSecurity();\n")
        ;
    }
}
