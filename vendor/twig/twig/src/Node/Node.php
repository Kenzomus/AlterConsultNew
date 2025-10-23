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
use Twig\Source;

/**
 * Represents a node in the AST.
 *
 * @author Fabien Potencier <fabien@symfony.com>
<<<<<<< HEAD
 *
 * @implements \IteratorAggregate<int|string, Node>
 */
#[YieldReady]
class Node implements \Countable, \IteratorAggregate
{
    /**
     * @var array<string|int, Node>
     */
=======
 */
class Node implements \Countable, \IteratorAggregate
{
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected $nodes;
    protected $attributes;
    protected $lineno;
    protected $tag;

    private $sourceContext;
<<<<<<< HEAD
    /** @var array<string, NameDeprecation> */
    private $nodeNameDeprecations = [];
    /** @var array<string, NameDeprecation> */
    private $attributeNameDeprecations = [];

    /**
     * @param array<string|int, Node> $nodes      An array of named nodes
     * @param array                   $attributes An array of attributes (should not be nodes)
     * @param int                     $lineno     The line number
     */
    public function __construct(array $nodes = [], array $attributes = [], int $lineno = 0)
    {
        if (self::class === static::class) {
            trigger_deprecation('twig/twig', '3.15', \sprintf('Instantiating "%s" directly is deprecated; the class will become abstract in 4.0.', self::class));
        }

        foreach ($nodes as $name => $node) {
            if (!$node instanceof self) {
                throw new \InvalidArgumentException(\sprintf('Using "%s" for the value of node "%s" of "%s" is not supported. You must pass a \Twig\Node\Node instance.', get_debug_type($node), $name, static::class));
=======

    /**
     * @param array  $nodes      An array of named nodes
     * @param array  $attributes An array of attributes (should not be nodes)
     * @param int    $lineno     The line number
     * @param string $tag        The tag name associated with the Node
     */
    public function __construct(array $nodes = [], array $attributes = [], int $lineno = 0, string $tag = null)
    {
        foreach ($nodes as $name => $node) {
            if (!$node instanceof self) {
                throw new \InvalidArgumentException(sprintf('Using "%s" for the value of node "%s" of "%s" is not supported. You must pass a \Twig\Node\Node instance.', \is_object($node) ? \get_class($node) : (null === $node ? 'null' : \gettype($node)), $name, static::class));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }
        $this->nodes = $nodes;
        $this->attributes = $attributes;
        $this->lineno = $lineno;
<<<<<<< HEAD

        if (\func_num_args() > 3) {
            trigger_deprecation('twig/twig', '3.12', \sprintf('The "tag" constructor argument of the "%s" class is deprecated and ignored (check which TokenParser class set it to "%s"), the tag is now automatically set by the Parser when needed.', static::class, func_get_arg(3) ?: 'null'));
        }
    }

    public function __toString(): string
    {
        $repr = static::class;

        if ($this->tag) {
            $repr .= \sprintf("\n  tag: %s", $this->tag);
        }

        $attributes = [];
        foreach ($this->attributes as $name => $value) {
            if (\is_callable($value)) {
                $v = '\Closure';
            } elseif ($value instanceof \Stringable) {
                $v = (string) $value;
            } else {
                $v = str_replace("\n", '', var_export($value, true));
            }
            $attributes[] = \sprintf('%s: %s', $name, $v);
        }

        if ($attributes) {
            $repr .= \sprintf("\n  attributes:\n    %s", implode("\n    ", $attributes));
        }

        if (\count($this->nodes)) {
            $repr .= "\n  nodes:";
            foreach ($this->nodes as $name => $node) {
                $len = \strlen($name) + 6;
=======
        $this->tag = $tag;
    }

    public function __toString()
    {
        $attributes = [];
        foreach ($this->attributes as $name => $value) {
            $attributes[] = sprintf('%s: %s', $name, str_replace("\n", '', var_export($value, true)));
        }

        $repr = [static::class.'('.implode(', ', $attributes)];

        if (\count($this->nodes)) {
            foreach ($this->nodes as $name => $node) {
                $len = \strlen($name) + 4;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                $noderepr = [];
                foreach (explode("\n", (string) $node) as $line) {
                    $noderepr[] = str_repeat(' ', $len).$line;
                }

<<<<<<< HEAD
                $repr .= \sprintf("\n    %s: %s", $name, ltrim(implode("\n", $noderepr)));
            }
        }

        return $repr;
    }

    public function __clone()
    {
        foreach ($this->nodes as $name => $node) {
            $this->nodes[$name] = clone $node;
        }
=======
                $repr[] = sprintf('  %s: %s', $name, ltrim(implode("\n", $noderepr)));
            }

            $repr[] = ')';
        } else {
            $repr[0] .= ')';
        }

        return implode("\n", $repr);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * @return void
     */
    public function compile(Compiler $compiler)
    {
        foreach ($this->nodes as $node) {
<<<<<<< HEAD
            $compiler->subcompile($node);
=======
            $node->compile($compiler);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
    }

    public function getTemplateLine(): int
    {
        return $this->lineno;
    }

    public function getNodeTag(): ?string
    {
        return $this->tag;
    }

<<<<<<< HEAD
    /**
     * @internal
     */
    public function setNodeTag(string $tag): void
    {
        if ($this->tag) {
            throw new \LogicException('The tag of a node can only be set once.');
        }

        $this->tag = $tag;
    }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function hasAttribute(string $name): bool
    {
        return \array_key_exists($name, $this->attributes);
    }

    public function getAttribute(string $name)
    {
        if (!\array_key_exists($name, $this->attributes)) {
<<<<<<< HEAD
            throw new \LogicException(\sprintf('Attribute "%s" does not exist for Node "%s".', $name, static::class));
        }

        $triggerDeprecation = \func_num_args() > 1 ? func_get_arg(1) : true;
        if ($triggerDeprecation && isset($this->attributeNameDeprecations[$name])) {
            $dep = $this->attributeNameDeprecations[$name];
            if ($dep->getNewName()) {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Getting attribute "%s" on a "%s" class is deprecated, get the "%s" attribute instead.', $name, static::class, $dep->getNewName());
            } else {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Getting attribute "%s" on a "%s" class is deprecated.', $name, static::class);
            }
=======
            throw new \LogicException(sprintf('Attribute "%s" does not exist for Node "%s".', $name, static::class));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $this->attributes[$name];
    }

    public function setAttribute(string $name, $value): void
    {
<<<<<<< HEAD
        $triggerDeprecation = \func_num_args() > 2 ? func_get_arg(2) : true;
        if ($triggerDeprecation && isset($this->attributeNameDeprecations[$name])) {
            $dep = $this->attributeNameDeprecations[$name];
            if ($dep->getNewName()) {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Setting attribute "%s" on a "%s" class is deprecated, set the "%s" attribute instead.', $name, static::class, $dep->getNewName());
            } else {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Setting attribute "%s" on a "%s" class is deprecated.', $name, static::class);
            }
        }

        $this->attributes[$name] = $value;
    }

    public function deprecateAttribute(string $name, NameDeprecation $dep): void
    {
        $this->attributeNameDeprecations[$name] = $dep;
    }

=======
        $this->attributes[$name] = $value;
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function removeAttribute(string $name): void
    {
        unset($this->attributes[$name]);
    }

<<<<<<< HEAD
    /**
     * @param string|int $name
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function hasNode(string $name): bool
    {
        return isset($this->nodes[$name]);
    }

<<<<<<< HEAD
    /**
     * @param string|int $name
     */
    public function getNode(string $name): self
    {
        if (!isset($this->nodes[$name])) {
            throw new \LogicException(\sprintf('Node "%s" does not exist for Node "%s".', $name, static::class));
        }

        $triggerDeprecation = \func_num_args() > 1 ? func_get_arg(1) : true;
        if ($triggerDeprecation && isset($this->nodeNameDeprecations[$name])) {
            $dep = $this->nodeNameDeprecations[$name];
            if ($dep->getNewName()) {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Getting node "%s" on a "%s" class is deprecated, get the "%s" node instead.', $name, static::class, $dep->getNewName());
            } else {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Getting node "%s" on a "%s" class is deprecated.', $name, static::class);
            }
=======
    public function getNode(string $name): self
    {
        if (!isset($this->nodes[$name])) {
            throw new \LogicException(sprintf('Node "%s" does not exist for Node "%s".', $name, static::class));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $this->nodes[$name];
    }

<<<<<<< HEAD
    /**
     * @param string|int $name
     */
    public function setNode(string $name, self $node): void
    {
        $triggerDeprecation = \func_num_args() > 2 ? func_get_arg(2) : true;
        if ($triggerDeprecation && isset($this->nodeNameDeprecations[$name])) {
            $dep = $this->nodeNameDeprecations[$name];
            if ($dep->getNewName()) {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Setting node "%s" on a "%s" class is deprecated, set the "%s" node instead.', $name, static::class, $dep->getNewName());
            } else {
                trigger_deprecation($dep->getPackage(), $dep->getVersion(), 'Setting node "%s" on a "%s" class is deprecated.', $name, static::class);
            }
        }

        if (null !== $this->sourceContext) {
            $node->setSourceContext($this->sourceContext);
        }
        $this->nodes[$name] = $node;
    }

    /**
     * @param string|int $name
     */
=======
    public function setNode(string $name, self $node): void
    {
        $this->nodes[$name] = $node;
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function removeNode(string $name): void
    {
        unset($this->nodes[$name]);
    }

    /**
<<<<<<< HEAD
     * @param string|int $name
     */
    public function deprecateNode(string $name, NameDeprecation $dep): void
    {
        $this->nodeNameDeprecations[$name] = $dep;
    }

    /**
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return \count($this->nodes);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->nodes);
    }

    public function getTemplateName(): ?string
    {
        return $this->sourceContext ? $this->sourceContext->getName() : null;
    }

    public function setSourceContext(Source $source): void
    {
        $this->sourceContext = $source;
        foreach ($this->nodes as $node) {
            $node->setSourceContext($source);
        }
    }

    public function getSourceContext(): ?Source
    {
        return $this->sourceContext;
    }
}
