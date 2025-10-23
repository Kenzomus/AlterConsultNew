<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Profiler\NodeVisitor;

use Twig\Environment;
use Twig\Node\BlockNode;
use Twig\Node\BodyNode;
use Twig\Node\MacroNode;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
<<<<<<< HEAD
use Twig\Node\Nodes;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Profiler\Node\EnterProfileNode;
use Twig\Profiler\Node\LeaveProfileNode;
use Twig\Profiler\Profile;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class ProfilerNodeVisitor implements NodeVisitorInterface
{
<<<<<<< HEAD
    private $varName;

    public function __construct(
        private string $extensionName,
    ) {
        $this->varName = \sprintf('__internal_%s', hash(\PHP_VERSION_ID < 80100 ? 'sha256' : 'xxh128', $extensionName));
=======
    private $extensionName;
    private $varName;

    public function __construct(string $extensionName)
    {
        $this->extensionName = $extensionName;
        $this->varName = sprintf('__internal_%s', hash(\PHP_VERSION_ID < 80100 ? 'sha256' : 'xxh128', $extensionName));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function enterNode(Node $node, Environment $env): Node
    {
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): ?Node
    {
        if ($node instanceof ModuleNode) {
<<<<<<< HEAD
            $node->setNode('display_start', new Nodes([new EnterProfileNode($this->extensionName, Profile::TEMPLATE, $node->getTemplateName(), $this->varName), $node->getNode('display_start')]));
            $node->setNode('display_end', new Nodes([new LeaveProfileNode($this->varName), $node->getNode('display_end')]));
=======
            $node->setNode('display_start', new Node([new EnterProfileNode($this->extensionName, Profile::TEMPLATE, $node->getTemplateName(), $this->varName), $node->getNode('display_start')]));
            $node->setNode('display_end', new Node([new LeaveProfileNode($this->varName), $node->getNode('display_end')]));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        } elseif ($node instanceof BlockNode) {
            $node->setNode('body', new BodyNode([
                new EnterProfileNode($this->extensionName, Profile::BLOCK, $node->getAttribute('name'), $this->varName),
                $node->getNode('body'),
                new LeaveProfileNode($this->varName),
            ]));
        } elseif ($node instanceof MacroNode) {
            $node->setNode('body', new BodyNode([
                new EnterProfileNode($this->extensionName, Profile::MACRO, $node->getAttribute('name'), $this->varName),
                $node->getNode('body'),
                new LeaveProfileNode($this->varName),
            ]));
        }

        return $node;
    }

    public function getPriority(): int
    {
        return 0;
    }
}
