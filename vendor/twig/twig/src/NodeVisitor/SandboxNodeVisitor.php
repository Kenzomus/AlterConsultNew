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
use Twig\Node\CheckSecurityCallNode;
use Twig\Node\CheckSecurityNode;
use Twig\Node\CheckToStringNode;
<<<<<<< HEAD
use Twig\Node\Expression\ArrayExpression;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\Expression\Binary\ConcatBinary;
use Twig\Node\Expression\Binary\RangeBinary;
use Twig\Node\Expression\FilterExpression;
use Twig\Node\Expression\FunctionExpression;
use Twig\Node\Expression\GetAttrExpression;
<<<<<<< HEAD
use Twig\Node\Expression\Unary\SpreadUnary;
use Twig\Node\Expression\Variable\ContextVariable;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
use Twig\Node\Nodes;
=======
use Twig\Node\Expression\NameExpression;
use Twig\Node\ModuleNode;
use Twig\Node\Node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\PrintNode;
use Twig\Node\SetNode;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 */
final class SandboxNodeVisitor implements NodeVisitorInterface
{
    private $inAModule = false;
<<<<<<< HEAD
    /** @var array<string, int> */
    private $tags;
    /** @var array<string, int> */
    private $filters;
    /** @var array<string, int> */
=======
    private $tags;
    private $filters;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    private $functions;
    private $needsToStringWrap = false;

    public function enterNode(Node $node, Environment $env): Node
    {
        if ($node instanceof ModuleNode) {
            $this->inAModule = true;
            $this->tags = [];
            $this->filters = [];
            $this->functions = [];

            return $node;
        } elseif ($this->inAModule) {
            // look for tags
            if ($node->getNodeTag() && !isset($this->tags[$node->getNodeTag()])) {
<<<<<<< HEAD
                $this->tags[$node->getNodeTag()] = $node->getTemplateLine();
            }

            // look for filters
            if ($node instanceof FilterExpression && !isset($this->filters[$node->getAttribute('name')])) {
                $this->filters[$node->getAttribute('name')] = $node->getTemplateLine();
=======
                $this->tags[$node->getNodeTag()] = $node;
            }

            // look for filters
            if ($node instanceof FilterExpression && !isset($this->filters[$node->getNode('filter')->getAttribute('value')])) {
                $this->filters[$node->getNode('filter')->getAttribute('value')] = $node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            // look for functions
            if ($node instanceof FunctionExpression && !isset($this->functions[$node->getAttribute('name')])) {
<<<<<<< HEAD
                $this->functions[$node->getAttribute('name')] = $node->getTemplateLine();
=======
                $this->functions[$node->getAttribute('name')] = $node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            // the .. operator is equivalent to the range() function
            if ($node instanceof RangeBinary && !isset($this->functions['range'])) {
<<<<<<< HEAD
                $this->functions['range'] = $node->getTemplateLine();
=======
                $this->functions['range'] = $node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            if ($node instanceof PrintNode) {
                $this->needsToStringWrap = true;
                $this->wrapNode($node, 'expr');
            }

            if ($node instanceof SetNode && !$node->getAttribute('capture')) {
                $this->needsToStringWrap = true;
            }

            // wrap outer nodes that can implicitly call __toString()
            if ($this->needsToStringWrap) {
                if ($node instanceof ConcatBinary) {
                    $this->wrapNode($node, 'left');
                    $this->wrapNode($node, 'right');
                }
                if ($node instanceof FilterExpression) {
                    $this->wrapNode($node, 'node');
                    $this->wrapArrayNode($node, 'arguments');
                }
                if ($node instanceof FunctionExpression) {
                    $this->wrapArrayNode($node, 'arguments');
                }
            }
        }

        return $node;
    }

    public function leaveNode(Node $node, Environment $env): ?Node
    {
        if ($node instanceof ModuleNode) {
            $this->inAModule = false;

<<<<<<< HEAD
            $node->setNode('constructor_end', new Nodes([new CheckSecurityCallNode(), $node->getNode('constructor_end')]));
            $node->setNode('class_end', new Nodes([new CheckSecurityNode($this->filters, $this->tags, $this->functions), $node->getNode('class_end')]));
=======
            $node->setNode('constructor_end', new Node([new CheckSecurityCallNode(), $node->getNode('constructor_end')]));
            $node->setNode('class_end', new Node([new CheckSecurityNode($this->filters, $this->tags, $this->functions), $node->getNode('class_end')]));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        } elseif ($this->inAModule) {
            if ($node instanceof PrintNode || $node instanceof SetNode) {
                $this->needsToStringWrap = false;
            }
        }

        return $node;
    }

    private function wrapNode(Node $node, string $name): void
    {
        $expr = $node->getNode($name);
<<<<<<< HEAD
        if (($expr instanceof ContextVariable || $expr instanceof GetAttrExpression) && !$expr->isGenerator()) {
            $node->setNode($name, new CheckToStringNode($expr));
        } elseif ($expr instanceof SpreadUnary) {
            $this->wrapNode($expr, 'node');
        } elseif ($expr instanceof ArrayExpression) {
            foreach ($expr as $name => $_) {
                $this->wrapNode($expr, $name);
            }
=======
        if ($expr instanceof NameExpression || $expr instanceof GetAttrExpression) {
            $node->setNode($name, new CheckToStringNode($expr));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
    }

    private function wrapArrayNode(Node $node, string $name): void
    {
        $args = $node->getNode($name);
        foreach ($args as $name => $_) {
            $this->wrapNode($args, $name);
        }
    }

    public function getPriority(): int
    {
        return 0;
    }
}
