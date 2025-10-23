<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\NodeVisitor;

use Twig\Environment;
use Twig\Node\Node;

/**
 * Used to make node visitors compatible with Twig 1.x and 2.x.
 *
<<<<<<< HEAD
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since Twig 3.9 (to be removed in 4.0)
=======
 * To be removed in Twig 3.1.
 *
 * @author Fabien Potencier <fabien@symfony.com>
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
abstract class AbstractNodeVisitor implements NodeVisitorInterface
{
    final public function enterNode(Node $node, Environment $env): Node
    {
        return $this->doEnterNode($node, $env);
    }

    final public function leaveNode(Node $node, Environment $env): ?Node
    {
        return $this->doLeaveNode($node, $env);
    }

    /**
     * Called before child nodes are visited.
     *
     * @return Node The modified node
     */
    abstract protected function doEnterNode(Node $node, Environment $env);

    /**
     * Called after child nodes are visited.
     *
     * @return Node|null The modified node or null if the node must be removed
     */
    abstract protected function doLeaveNode(Node $node, Environment $env);
}
