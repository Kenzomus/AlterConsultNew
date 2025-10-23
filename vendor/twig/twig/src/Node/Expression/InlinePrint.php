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
use Twig\Node\Node;

/**
 * @internal
 */
final class InlinePrint extends AbstractExpression
{
<<<<<<< HEAD
    /**
     * @param AbstractExpression $node
     */
    public function __construct(Node $node, int $lineno)
    {
        trigger_deprecation('twig/twig', '3.16', \sprintf('The "%s" class is deprecated with no replacement.', static::class));

=======
    public function __construct(Node $node, int $lineno)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct(['node' => $node], [], $lineno);
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
<<<<<<< HEAD
            ->raw('yield ')
            ->subcompile($this->getNode('node'))
=======
            ->raw('print (')
            ->subcompile($this->getNode('node'))
            ->raw(')')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ;
    }
}
