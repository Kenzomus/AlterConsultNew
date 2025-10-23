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

use Twig\Compiler;

/**
 * Represents a parent node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ParentExpression extends AbstractExpression
{
<<<<<<< HEAD
    public function __construct(string $name, int $lineno)
    {
        parent::__construct([], ['output' => false, 'name' => $name], $lineno);
=======
    public function __construct(string $name, int $lineno, string $tag = null)
    {
        parent::__construct([], ['output' => false, 'name' => $name], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        if ($this->getAttribute('output')) {
            $compiler
                ->addDebugInfo($this)
<<<<<<< HEAD
                ->write('yield from $this->yieldParentBlock(')
=======
                ->write('$this->displayParentBlock(')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->string($this->getAttribute('name'))
                ->raw(", \$context, \$blocks);\n")
            ;
        } else {
            $compiler
                ->raw('$this->renderParentBlock(')
                ->string($this->getAttribute('name'))
                ->raw(', $context, $blocks)')
            ;
        }
    }
}
